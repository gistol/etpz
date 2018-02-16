<?php

use Website\Controller\Action;

class EtpzController extends Action {

    public function init() {
        parent::init();
        $this->enableLayout();
    }

    public function catalogAction() {
        $List_array_category = new Object\Category\Listing();
        $List_array_category->load();
        $category_array = array();
        foreach ($List_array_category as $category) {
            $category_array[$category->getId()] = $category->getName();
        }
        $this->view->category_array = $category_array;


        $List_array_currency = new Object\Currency\Listing();
        $List_array_currency->load();
        $currency_array = array();
        foreach ($List_array_currency as $currency) {
            $currency_array[$currency->getName()]['name'] = $currency->getName();
            $currency_array[$currency->getName()]['rate'] = $currency->getRate();
        }
        $this->view->currency_array = $currency_array;


        $List_array_products = new Object\Product\Listing();
        if (isset($_GET['price']) && $_GET['price']) {
            $List_array_products->setOrderKey("price");
            $List_array_products->setOrder($_GET['price']);
        } else {
            $List_array_products->setOrderKey("xmlproductid");
            $List_array_products->setOrder("desc");
        }
        $List_array_products->load();
        $paginator = \Zend_Paginator::factory($List_array_products);
        $paginator->setCurrentPageNumber($this->getParam('page'));
        $paginator->setItemCountPerPage(10);

        $this->view->products = $paginator;
    }

    public function brandsAction() {
        $List_array_products = new Object\Product\Listing();
        $List_array_products->setOrderKey("xmlproductid");
        $List_array_products->setOrder("desc");
        $List_array_products->load();
        $brand_array = array();
        foreach ($List_array_products as $product) {
            $brand_array[$product->getBrand_name()]['name'] = $product->getBrand_name();
        }

        $this->view->brands = $brand_array;
    }

    public function brandviewAction() {
        $brand_name = $this->getParam("brand_name");
        if (isset($brand_name)) {
            $List_array_category = new Object\Category\Listing();
            $List_array_category->load();
            $category_array = array();
            foreach ($List_array_category as $category) {
                $category_array[$category->getId()] = $category->getName();
            }
            $this->view->category_array = $category_array;


            $List_array_currency = new Object\Currency\Listing();
            $List_array_currency->load();
            $currency_array = array();
            foreach ($List_array_currency as $currency) {
                $currency_array[$currency->getName()]['name'] = $currency->getName();
                $currency_array[$currency->getName()]['rate'] = $currency->getRate();
            }
            $this->view->currency_array = $currency_array;

            $List_array_products = new Object\Product\Listing();
            $List_array_products->setOrderKey("xmlproductid");
            $List_array_products->setOrder("desc");
            $List_array_products->setCondition("brand_name = " . $List_array_products->quote($brand_name));
            $List_array_products->load();

            $paginator = \Zend_Paginator::factory($List_array_products);
            $paginator->setCurrentPageNumber($this->getParam('page'));
            $paginator->setItemCountPerPage(10);

            $this->view->products = $paginator;
        }
    }

    public function productAction() {
        $item_o_key = $this->getParam("item_id");
        if (is_numeric($item_o_key)) {
            $product_object = Object\Product::getById($item_o_key);
            $this->view->product = $product_object;


            $List_array_category = new Object\Category\Listing();
            $List_array_category->setCondition("xmlid = " . $product_object->getCategoryid());
            $List_array_category->load();
            foreach ($List_array_category as $category) {
                $category_object = Object\Category::getById($category->getId());
            }
            $this->view->category = $category_object->getName();


            $List_array_currency = new Object\Currency\Listing();
            $List_array_currency->setCondition("name = " . $List_array_currency->quote($product_object->getCurrencyid()));
            $List_array_currency->load();
            foreach ($List_array_currency as $currency) {
                $currency_object = Object\Currency::getById($currency->getId());
            }

            if ($currency_object->getName() == "RUB") {
                $this->view->product_price = $product_object->getPrice();
            } else {
                $this->view->product_price = $product_object->getPrice() * $currency_object->getRate();
            }
        }
    }

    public function statisticsAction() {
        $List_array_category = new Object\Category\Listing();
        $List_array_category->load();
        $category_array = array();
        foreach ($List_array_category as $category) {
            $category_array[$category->getXmlid()]['id'] = $category->getXmlid();
            $category_array[$category->getXmlid()]['name'] = $category->getName();
            $category_array[$category->getXmlid()]['parent_id'] = $category->getXmlparentid();
        }



        $List_array_currency = new Object\Currency\Listing();
        $List_array_currency->load();
        $currency_array = array();
        foreach ($List_array_currency as $currency) {
            $currency_array[$currency->getName()]['name'] = $currency->getName();
            $currency_array[$currency->getName()]['rate'] = $currency->getRate();
        }

        $product_array = array();
        $List_array_products = new Object\Product\Listing();
        $List_array_products->load();
        foreach ($List_array_products as $product) {
            $product_array[] = $product;
        }

        $category_tree = array();
        $category_tree = $this->buildTree($category_array, $product_array, $currency_array);
        $this->view->category_tree = $category_tree;


        $brands_array = array();
        foreach ($product_array as $product) {
            $brands_array[$product->getBrand_name()]['name'] = $product->getBrand_name();
            $brands_array[$product->getBrand_name()]['count_products'] += 1;

            if ($product->getCurrencyid() == "RUB") {
                $brands_array[$product->getBrand_name()]['price_rub'] += $product->getPrice();
                $brands_array[$product->getBrand_name()]['price_usd'] += round($product->getPrice() / $currency_array['USD']['rate']);
            } else {
                $brands_array[$product->getBrand_name()]['price_usd'] += $product->getPrice();
                $brands_array[$product->getBrand_name()]['price_rub'] += round($product->getPrice() * $currency_array['USD']['rate']);
            }
        }
        $this->view->brands_array = $brands_array;
    }

    public function statisticscategoryAction() {
        $category = $this->getParam("category");

        $explCategoryItems = explode("/", $category);
        $last_category = array_values(array_slice($explCategoryItems, -1))[0];
        if (is_numeric($last_category)) {
            $List_array_category = new Object\Category\Listing();
//$List_array_category->setCondition('xmlid = ' . implode(" OR xmlid = ", $explCategoryItems));
            $List_array_category->setCondition('xmlid = ' . $last_category);
            $List_array_category->load();
            foreach ($List_array_category as $category) {
                $category_object = Object\Category::getById($category->getId());
            }
            $this->view->category = $category_object;



            $List_array_category = new Object\Category\Listing();
            $List_array_category->load();
            $category_array = array();
            foreach ($List_array_category as $category) {

                $category_array[$category->getXmlid()]['id'] = $category->getXmlid();
                $category_array[$category->getXmlid()]['name'] = $category->getName();
                $category_array[$category->getXmlid()]['parent_id'] = $category->getXmlparentid();
            }


            $List_array_currency = new Object\Currency\Listing();
            $List_array_currency->load();
            $currency_array = array();
            foreach ($List_array_currency as $currency) {
                $currency_array[$currency->getName()]['name'] = $currency->getName();
                $currency_array[$currency->getName()]['rate'] = $currency->getRate();
            }

            $List_array_products = new Object\Product\Listing();
            $List_array_products->load();
            foreach ($List_array_products as $product) {
                $product_array[] = $product;
            }



            $category_tree = $this->buildTree($category_array, $product_array, $currency_array);
            $this->view->category_tree = $category_tree;

            $brands_array = array();
            foreach ($product_array as $product) {

                if ($product->getCategoryid() == $category_object->getXmlid()) {
                    $brands_array[$product->getBrand_name()]['name'] = $product->getBrand_name();
                    $brands_array[$product->getBrand_name()]['count_products'] += 1;

                    if ($product->getCurrencyid() == "RUB") {
                        $brands_array[$product->getBrand_name()]['price_rub'] += $product->getPrice();
                        $brands_array[$product->getBrand_name()]['price_usd'] += round($product->getPrice() / $currency_array['USD']['rate']);
                    } else {
                        $brands_array[$product->getBrand_name()]['price_usd'] += $product->getPrice();
                        $brands_array[$product->getBrand_name()]['price_rub'] += round($product->getPrice() * $currency_array['USD']['rate']);
                    }
                }
            }
            $this->view->brands_array = $brands_array;
        }
    }

    public function importproductsAction() {
        $this->disableLayout();
        $this->disableViewAutorender();

        $get = file_get_contents('tmp/import/offer-1.xml');
        $arr = simplexml_load_string($get);
        $json = json_encode($arr);
        $configData = json_decode($json, true);

        $List_array_currency = new Object\Currency\Listing();
        $List_array_currency->load();
        $currency_array = array();
        foreach ($List_array_currency as $currency) {
            $currency_array[$currency->getName()]['id'] = $currency->getId();
        }
        foreach ($configData['shop']['currencies'] as $currency) {
            foreach ($currency as $attr) {
                foreach ($attr as $a) {
                    $currency_object = Object\Currency::getById($currency_array[$a['id']]['id']);
                    $currency_object->setRate($a['rate']);
                    $currency_object->save();
                }
            }
        }


        foreach ($configData['shop']['offers']['offer'] as $offer) {
            if ($offer['name'] != "unknown") {
                $productname = 'product-' . $offer['@attributes']['id'];
                if (!Object\Product::getByPath('/products/' . $productname)) {
                    $newproduct = Object_Product::create(array(
                                'xmlproductid' => $offer['@attributes']['id'],
                                'name' => $offer['name'],
                                'description' => $offer['description'],
                                'price' => $offer['price'],
                                'categoryId' => $offer['categoryId'],
                                'currencyId' => $offer['currencyId'],
                                'brand_name' => $offer['brand_name'],
                                'picture' => Asset::getById(16),
                                'modified_datetime' => new DateTime(str_replace("T", ' ', $offer['modified_datetime'])),
                    ));
                    $newproduct->setKey(Pimcore_File::getValidFilename($productname));
                    $newproduct->setParentId(2937);
                    $newproduct->setPublished(true);
                    $newproduct->save();
                } else {
                    $product_object = Object\Product::getByPath('/products/' . $productname);
                    $product_object->setXmlproductid($offer['@attributes']['id']);
                    $product_object->setName($offer['name']);
                    $product_object->setDescription($offer['description']);
                    $product_object->setPrice($offer['price']);
                    $product_object->setCategoryId($offer['categoryId']);
                    $product_object->setCurrencyId($offer['currencyId']);
                    $product_object->setBrand_name($offer['brand_name']);
                    $product_object->setPicture(Asset::getById(16));
                    $product_object->setModified_datetime(new DateTime(str_replace("T", ' ', $offer['modified_datetime'])));
                    $product_object->save();
                }
            } else {
                $json_data['error-products'] = array();

                $newar[] = array(
                    'name' => $offer['name'],
                    'description' => $offer['description'],
                    'price' => $offer['price'],
                    'categoryId' => $offer['categoryId'],
                    'currencyId' => $offer['currencyId'],
                    'brand_name' => $offer['brand_name'],
                    'picture' => $offer['picture'],
                    'modified_datetime' => $offer['modified_datetime'],
                );

                array_push($json_data['error-products'], $newar);
                $json = json_encode($json_data);
                file_put_contents('tmp/import/error-log.txt', $json);

                $import_error = ', но с ошибками. Логи сохранены в tmp/import/error-log.txt';
            }
        }
        echo 'Импорт завершен' . ($import_error ? $import_error : ".");
    }

    public function exportproductsAction() {
        $this->disableLayout();
        $this->disableViewAutorender();

        $List_array_category = new Object\Category\Listing();
        $List_array_category->load();
        $category_array = array();
        foreach ($List_array_category as $category) {
            $category_array[$category->getXmlid()]['id'] = $category->getXmlid();
            $category_array[$category->getXmlid()]['name'] = $category->getName();
            $category_array[$category->getXmlid()]['parent_id'] = $category->getXmlparentid();
        }



        $List_array_currency = new Object\Currency\Listing();
        $List_array_currency->load();
        $currency_array = array();
        foreach ($List_array_currency as $currency) {
            $currency_array[$currency->getName()]['name'] = $currency->getName();
            $currency_array[$currency->getName()]['rate'] = $currency->getRate();
        }

        $product_array = array();
        $List_array_products = new Object\Product\Listing();
        $List_array_products->load();
        foreach ($List_array_products as $product) {
            $product_array[] = $product;
        }

        $category_tree = array();
        $category_tree = $this->buildTree($category_array, $product_array, $currency_array);
        $this->view->category_tree = $category_tree;


        $brands_array = array();
        foreach ($product_array as $product) {
            $brands_array[$product->getBrand_name()]['name'] = $product->getBrand_name();
            $brands_array[$product->getBrand_name()]['count_products'] += 1;

            if ($product->getCurrencyid() == "RUB") {
                $brands_array[$product->getBrand_name()]['price_rub'] += $product->getPrice();
                $brands_array[$product->getBrand_name()]['price_usd'] += round($product->getPrice() / $currency_array['USD']['rate']);
            } else {
                $brands_array[$product->getBrand_name()]['price_usd'] += $product->getPrice();
                $brands_array[$product->getBrand_name()]['price_rub'] += round($product->getPrice() * $currency_array['USD']['rate']);
            }
        }
        $this->view->brands_array = $brands_array;

        function array_to_xml($data, $xml_data) {
            foreach ($data as $key => $value) {
                if (is_numeric($key)) {
                    $key = 'item' . $key; //dealing with <0/>..<n/> issues
                }
                if (is_array($value)) {
                    $subnode = $xml_data->addChild($key);
                    array_to_xml($value, $subnode);
                } else {
                    $xml_data->addChild("$key", htmlspecialchars("$value"));
                }
            }
        }

        $xml_data = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><data></data>');

        array_to_xml($category_tree, $xml_data);
        $result = $xml_data->asXML('tmp/export/export-category.xml');

        array_to_xml($brands_array, $xml_data);
        $result = $xml_data->asXML('tmp/export/export-brands.xml');


        if ($result) {
            echo 'XML файл успешно сгенерирован.';
        } else {
            echo 'Ошибка при генерации файла XML.';
        }
    }

    private function buildTree(array $elements, array $products, $currency, $parentId = 0) {
        $branch = array();
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $products, $currency, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                foreach ($products as $product) {
                    if ($product->getCategoryid() == $element['id']) {
                        $element['products'][$product->getId()]['id'] = $product->getId();
                        $element['products'][$product->getId()]['price'] = $product->getPrice();
                        $element['products'][$product->getId()]['currencyId'] = $product->getCurrencyid();
                        $element['products'][$product->getId()]['brand_name'] = $product->getBrand_name();

                        $element['brands'][$product->getBrand_name()]['name'] = $product->getBrand_name();
                        $element['brands'][$product->getBrand_name()]['count_products'] += 1;
                        if ($product->getCurrencyid() == "RUB") {
                            $element['brands'][$product->getBrand_name()]['price'] += $product->getPrice();
                        } else {
                            $element['brands'][$product->getBrand_name()]['price'] += round($product->getPrice() * $currency[$product->getCurrencyid()]['rate']);
                        }
                    }
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }

}
