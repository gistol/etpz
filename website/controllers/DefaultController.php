<?php

use Website\Controller\Action;

class DefaultController extends Action {

    public function defaultAction() {
        $fileName = "data.csv";
        $csvData = file_get_contents($fileName);
        $lines = explode("\n", $csvData);
        $array = array();
        foreach ($lines as $line) {
            $array[] = explode(";", $line);
        }


        foreach ($array as $list) {
            //  echo $value;
            $object_key = str_replace('/', '-', $list[0]) . "_" . $list[1];

            $new_array[str_replace('/', '-', $list[0])][$object_key]['name'] = $list[0];
            $new_array[str_replace('/', '-', $list[0])][$object_key]['parentkey'] = str_replace('/', '-', $list[0]);
            $new_array[str_replace('/', '-', $list[0])][$object_key]['val'] = $list[1];

            //$new_array[$list[0]][] = $list[1];
        }

        //echo "<pre>";
        //print_r($array);

        $fileName = "collectiondata.csv";
        $csvData = file_get_contents($fileName);
        $lines = explode("\n", $csvData);
        $collection_array = array();
        foreach ($lines as $line) {
            $collection_array[] = explode(";", $line);
        }
        echo "<pre>";
        //print_r($collection_array);


        $big_array = array();
        foreach ($collection_array as $list) {
            //  echo $value;
            $object_key = $text = str_replace('/', '-', $list[3]) . "_" . $list[4];
            $object_key = str_replace(' ', '-', $object_key);
            $new_collection_array[$object_key]['name'] = $list[3];
            $new_collection_array[$object_key]['val'] = $list[4];
            if (!$new_collection_array[$object_key]['maincategory']) {
                $new_collection_array[$object_key]['maincategory'] = array();
            }
            if (!$new_collection_array[$object_key]['subcategory']) {
                $new_collection_array[$object_key]['subcategory'] = array();
            }
            if (!$new_collection_array[$object_key]['category']) {
                $new_collection_array[$object_key]['category'] = array();
            }
            if (!$new_collection_array[$object_key]['collection']) {
                $new_collection_array[$object_key]['collection'] = array();
            }
            if (!preg_match('/[?]/', $list[0]) && !preg_match('/[?]/', $list[1]) && !preg_match('/[?]/', $list[2]) && !preg_match('/[?]/', $list[3]) && !preg_match('/[?]/', $list[5])) {
                $big_array['category']['maincategory'][str_replace('/', '-', $list[0])][str_replace('/', '-', $list[5])] = str_replace('/', '-', $list[5]);
                $big_array['category']['subcategory'][str_replace('/', '-', $list[1])][str_replace('/', '-', $list[5])] = str_replace('/', '-', $list[5]);
                $big_array['category']['category'][str_replace('/', '-', $list[2])][str_replace('/', '-', $list[5])] = str_replace('/', '-', $list[5]);
                $big_array['collection']['attributes'][str_replace('/', '-', $list[5])][$object_key] = $object_key;
                $big_array['collection']['category'][str_replace('/', '-', $list[5])][str_replace('/', '-', $list[0])] = str_replace('/', '-', $list[0]);
                $big_array['collection']['category'][str_replace('/', '-', $list[5])][str_replace('/', '-', $list[1])] = str_replace('/', '-', $list[1]);
                $big_array['collection']['category'][str_replace('/', '-', $list[5])][str_replace('/', '-', $list[2])] = str_replace('/', '-', $list[2]);
                $big_array['attributes']['collection'][$object_key][str_replace('/', '-', $list[5])] = str_replace('/', '-', $list[5]);
                $big_array['attributes']['category'][$object_key][str_replace('/', '-', $list[2])] = str_replace('/', '-', $list[2]);
            }

            if (!preg_match('/[?]/', $list[0])) {
                if (!in_array(str_replace('/', '-', $list[0]), $new_collection_array[$object_key]['maincategory'])) {
                    $new_collection_array[$object_key]['maincategory'][] = str_replace('/', '-', $list[0]);
                }
            }
            if (!preg_match('/[?]/', $list[1])) {
                if (!in_array(str_replace('/', '-', $list[1]), $new_collection_array[$object_key]['subcategory'])) {
                    $new_collection_array[$object_key]['subcategory'][] = str_replace('/', '-', $list[1]);
                }
            }
            if (!preg_match('/[?]/', $list[2])) {
                if (!in_array(str_replace('/', '-', $list[2]), $new_collection_array[$object_key]['category'])) {
                    $new_collection_array[$object_key]['category'][] = str_replace('/', '-', $list[2]);
                }
            }
            if (!preg_match('/[?]/', $list[5])) {
                if (!in_array(str_replace('/', '-', $list[5]), $new_collection_array[$object_key]['collection'])) {
                    $new_collection_array[$object_key]['collection'][] = str_replace('/', '-', $list[5]);
                }
            }


            /* $new_collection_array[$object_key]['maincategory'][] = $list[0];
              $new_collection_array[$object_key]['subcategory'][] = $list[1];
              $new_collection_array[$object_key]['category'][] = $list[2];
              $new_collection_array[$object_key]['collection'][] = $list[5]; */


            //$new_collection_array[$list[0]][] = $list[1];
        }

        echo "<pre>";
        print_r($big_array);

        $objects = array();
        $object_item_id = 0;
        $project_item = 0;
        foreach ($big_array['category'] as $category_array) {
            foreach ($category_array as $category_key => $category) {
                if ($category_key) {
                    $objects = array();
                    $objects = new Object\Categories\Listing();
                    $category_key = str_ireplace(array("\r", "\n", '\r', '\n'), '', $category_key);
                    $objects->setCondition("o_key =  '$category_key'");
                    $objects->load();
                    foreach ($objects as $object) {
                        $object_item_id = $object->getId();
                    }

                    if (is_numeric($object_item_id)) {
                        $project_item = Object\Categories::getById($object_item_id);
echo $object_item_id;
                        $references_collection = array();
                        if (count($category) >= 1) {
                            foreach ($category as $collection) {
                                $collection = str_ireplace(array("\r", "\n", '\r', '\n'), '', $collection);
                                $objects_collection = new Object\Collection\Listing();
                                //$objects_category->setCondition("name like '%,".$category.",%'");
                                $objects_collection->setCondition('o_key = ' . $objects->quote($collection));
                                $objects_collection->load();
                                foreach ($objects_collection as $object_collection) {
                                    $object_collection_item_id = $object_collection->getId();
                                }
                                if (is_numeric($object_collection_item_id)) {
                                    echo $object_collection_item_id . "<br>";
                                    $collection_item = Object\Collection::getById($object_collection_item_id);
                                    $collection__elementMetadata = new Object\Data\ObjectMetadata('metadata', [], $collection_item);
                                    $references_collection[] = $collection__elementMetadata;
                                }
                            }
                            $project_item->setCollection($references_collection);
                            $project_item->save();
                        }
                    }
                }
            }
        }

        $objects = array();
        $object_item_id = 0;
        $project_item = 0;
        foreach ($big_array['collection']['attributes'] as $collection_key => $collection) {
            //echo $collection_key . "<br>";
            if ($collection_key) {
                $objects = new Object\Collection\Listing();
                $collection_key = str_ireplace(array("\r", "\n", '\r', '\n'), '', $collection_key);
                //$objects->setCondition("o_key =  '$collection_key'");
                $objects->setCondition("o_key =  '$collection_key'");
                $objects->load();
                foreach ($objects as $object) {
                    $object_item_id = $object->getId();
                }
                //print_r($objects);

                if (is_numeric($object_item_id)) {
                    $project_item = Object\Collection::getById($object_item_id);

                    $references_attributes = array();
                    if (count($collection) >= 1) {
                        foreach ($collection as $attributes) {
                            $attributes = str_ireplace(array("\r", "\n", '\r', '\n'), '', $attributes);
                            $objects_attributes = new Object\ProductAttributes\Listing();
                            //$objects_category->setCondition("name like '%,".$category.",%'");
                            $objects_attributes->setCondition('o_key = ' . $objects->quote($attributes));
                            $objects_attributes->load();
                            foreach ($objects_attributes as $object_attributes) {
                                $object_attributes_item_id = $object_attributes->getId();
                            }
                            if (is_numeric($object_attributes_item_id)) {

                                $attributes_item = Object\ProductAttributes::getById($object_attributes_item_id);
                                $attributes__elementMetadata = new Object\Data\ObjectMetadata('metadata', [], $attributes_item);
                                $references_attributes[] = $attributes__elementMetadata;
                            }
                        }
                        //echo $object_item_id . "<br>";
                        $project_item->setRelated_attributes_to_collection($references_attributes);
                        $project_item->save();
                    }
                }
            }
        }

        $objects = array();
        $object_item_id = 0;
        $project_item = 0;
        foreach ($big_array['collection']['category'] as $collection_key => $collection) {
            //echo $collection_key . "<br>";
            if ($collection_key) {
                $objects = new Object\Collection\Listing();
                $collection_key = str_ireplace(array("\r", "\n", '\r', '\n'), '', $collection_key);
                //$objects->setCondition("o_key =  '$collection_key'");
                $objects->setCondition("o_key =  '$collection_key'");
                $objects->load();
                foreach ($objects as $object) {
                    $object_item_id = $object->getId();
                }
                //print_r($objects);
                // echo $object_item_id . "<br>";
                if (is_numeric($object_item_id)) {
                    $project_item = Object\Collection::getById($object_item_id);

                    $references_attributes = array();
                    if (count($collection) >= 1) {
                        foreach ($collection as $category) {
                            echo $category . "<br>";
                            $category = str_ireplace(array("\r", "\n", '\r', '\n'), '', $category);
                            $objects_category = new Object\Categories\Listing();
                            //$objects_category->setCondition("name like '%,".$category.",%'");
                            $objects_category->setCondition('o_key = ' . $objects->quote($category));
                            $objects_category->load();
                            foreach ($objects_category as $object_category) {
                                $object_category_item_id = $object_category->getId();
                            }

                            if (is_numeric($object_category_item_id)) {

                                $category_item = Object\Categories::getById($object_category_item_id);
                                $category__elementMetadata = new Object\Data\ObjectMetadata('metadata', [], $category_item);
                                $references_category[] = $category__elementMetadata;
                            }
                        }

                        $project_item->setRelated_cat_attributes_to_collection($references_category);
                        $project_item->save();
                    }
                }
            }
        }


        $objects = array();
        $object_item_id = 0;
        $project_item = 0;
        foreach ($big_array['attributes']['collection'] as $attribute_key => $attribute) {
            if ($attribute_key) {
                $objects = new Object\ProductAttributes\Listing();
                $attribute_key = str_ireplace(array("\r", "\n", '\r', '\n'), '', $attribute_key);
                $objects->setCondition("o_key =  '$attribute_key'");
                $objects->load();
                foreach ($objects as $object) {
                    $object_item_id = $object->getId();
                }

                if (is_numeric($object_item_id)) {
                    $project_item = Object\ProductAttributes::getById($object_item_id);

                    $references_collection = array();
                    if (count($attribute) >= 1) {
                        foreach ($attribute as $collection) {
                            $collection = str_ireplace(array("\r", "\n", '\r', '\n'), '', $collection);
                            $objects_collection = new Object\Collection\Listing();
                            //$objects_category->setCondition("name like '%,".$category.",%'");
                            $objects_collection->setCondition('o_key = ' . $objects->quote($collection));
                            $objects_collection->load();
                            foreach ($objects_collection as $object_collection) {
                                $object_collection_item_id = $object_collection->getId();
                            }
                            if (is_numeric($object_collection_item_id)) {

                                $collection_item = Object\Collection::getById($object_collection_item_id);
                                $collection__elementMetadata = new Object\Data\ObjectMetadata('metadata', [], $collection_item);
                                $references_collection[] = $collection__elementMetadata;
                            }
                        }
                        $project_item->setproduct_attribute_related_to_Collection($references_collection);
                        $project_item->save();
                    }
                }
            }
        }


        $objects = array();
        $object_item_id = 0;
        $project_item = 0;
        foreach ($big_array['attributes']['category'] as $attribute_key => $attribute) {
            if ($attribute_key) {
                $objects = new Object\ProductAttributes\Listing();
                $attribute_key = str_ireplace(array("\r", "\n", '\r', '\n'), '', $attribute_key);
                $objects->setCondition("o_key =  '$attribute_key'");
                $objects->load();
                foreach ($objects as $object) {
                    $object_item_id = $object->getId();
                }

                if (is_numeric($object_item_id)) {
                    $project_item = Object\ProductAttributes::getById($object_item_id);

                    $references_category = array();
                    if (count($attribute) >= 1) {
                        foreach ($attribute as $category) {
                            $category = str_ireplace(array("\r", "\n", '\r', '\n'), '', $category);
                            $objects_category = new Object\Categories\Listing();
                            //$objects_category->setCondition("name like '%,".$category.",%'");
                            $objects_category->setCondition('o_key = ' . $objects->quote($category));
                            $objects_category->load();
                            foreach ($objects_category as $object_category) {
                                $object_category_item_id = $object_category->getId();
                            }
                            if (is_numeric($object_category_item_id)) {

                                $category_item = Object\Categories::getById($object_category_item_id);
                                $category__elementMetadata = new Object\Data\ObjectMetadata('metadata', [], $category_item);
                                $references_category[] = $category__elementMetadata;
                            }
                        }
                        $project_item->setproduct_attribute_related_to_Category_3($references_category);
                        $project_item->save();
                    }
                }
            }
        }


        //$defProperty = Object::getByKey('12 oz. Bottle Capacity_21');
        //"`key` = 'your-document-key' "
        foreach ($new_collection_array as $object_key => $object_value) {

            if ($object_key) {
                $objects = new Object\ProductAttributes\Listing();
                $objects->setCondition("o_key =  '$object_key'");
                $objects->load();
                foreach ($objects as $object) {
                    $object_item_id = $object->getId();
                }

                if (is_numeric($object_item_id)) {
                    $project_item = Object\ProductAttributes::getById($object_item_id);

                    $references_category = array();
                    if ($object_value['category']) {
                        foreach ($object_value['category'] as $category) {
                            $category = str_ireplace(array("\r", "\n", '\r', '\n'), '', $category);
                            $objects_category = new Object\Categories\Listing();
                            //$objects_category->setCondition("name like '%,".$category.",%'");
                            $objects_category->setCondition('o_key = ' . $objects->quote($category));
                            $objects_category->load();
                            foreach ($objects_category as $object_category) {
                                $object_category_item_id = $object_category->getId();
                            }
                            if (is_numeric($object_category_item_id)) {

                                $category_item = Object\Categories::getById($object_category_item_id);
                                $category__elementMetadata = new Object\Data\ObjectMetadata('metadata', [], $category_item);
                                $references_category[] = $category__elementMetadata;
                            }
                        }
                        $project_item->setProduct_attribute_related_to_Category_3($references_category);
                        //$project_item->save();
                    }
                }
            }
        }


        /* $objects = new Object\ProductAttribute\Listing();
          $objects->setCondition('o_key = ?', "12-oz.-bottle-capacity_21");
          $objects->load(); */
        //echo "<pre>";
        //print_r($objects);
        // echo "<pre>";
        //print_r($new_array);
        //echo "<pre>";

        foreach ($new_array as $parent_key => $parent_key_value) {
            if ($parent_key) {


                $success = false;
                $parent = Object::getById(1368);
                /* echo $parent->getFullPath() . "/" . $parent_key . "<br>";
                  $folder = Object\Folder::getByPath($parent->getFullPath() . "/" . $parent_key);
                  $folderid = $folder->getId();
                  echo $folderid; */
                if (!Object\Folder::getByPath($parent->getFullPath() . "/" . $parent_key)) {
                    //$folder = Object\Folder::create(array("o_parentId" => $this->getParam("parentId"), "o_creationDate" => time(), "o_userOwner" => $this->user->getId(), "o_userModification" => $this->user->getId(), "o_key" => $this->getParam("key"), "o_published" => true));
                    $folder = Object\Folder::create(array("o_parentId" => 1368, "o_creationDate" => time(), "o_userOwner" => 1, "o_userModification" => 1, "o_key" => $parent_key, "o_published" => true));
                    $folder->setCreationDate(time());
                    $folder->setUserOwner(1);
                    $folder->setUserModification(1);
                    try {
                        $folder->save();
                        $folderid = $folder->getId();
                        $success = true;
                    } catch (\Exception $e) {
                        $this->_helper->json(array("success" => false, "message" => $e->getMessage()));
                    }
                } else {
                    $folder = Object\Folder::getByPath($parent->getFullPath() . "/" . $parent_key);
                    $folderid = $folder->getId();
                }
            }



            foreach ($parent_key_value as $key => $value) {
                $value_numeric_matches = array();
                $value_notnumeric_matches = array();
                $value_numeric = $value['val'];
                $value_notnumeric = $value['val'];
                preg_match_all('!\d!', $value_numeric, $value_numeric_matches);
                preg_match_all('!\d!', $value_notnumeric, $value_notnumeric_matches);
                // print_r($value_numeric_matches);
                //echo $value_notnumeric_matches[1];
                // echo preg_replace('/[^0-9]+/', '', $value['val']) . "<br>";
                //echo intval(preg_replace('/[^A-Z,a-z]+/', '', $value['val']), 10) . "<br>";
                //echo preg_replace('/[^a-z_\-]/i', '', $value['val'])  . "<br>";
                $newobject = Object_ProductAttributes::create(array(
                            'name' => $value['name'],
                            'val' => $value['val'],
                            'valnum' => preg_replace('/[^0-9]+/', '', $value['val']),
                            'option' => preg_replace('/[^a-z_\-]/i', '', $value['val']),
                            'parentkey' => $value['parentkey'],
                ));
                $newobject->setKey(Pimcore_File::getValidFilename($key));
                $newobject->setParentId($folder->getId());
                $newobject->setPublished(true);
                //$newobject->save();
            }
        }





        /* foreach ($new_array as $key => $value) {



          $objectname = $key . substr(md5(time()), 0, 5);
          $newobject = Object_ProductAttribute::create(array(
          'name' => $key,
          'val' => $items,
          ));
          } */

        /*  $object = new Object\ProductAttribute();

          $object->setParentId(1149);
          $object->setUserOwner(1);
          $object->setUserModification(1);
          $object->setCreationDate(time());
          $object->setKey(uniqid() . rand(10, 99));

          $items = new Object\Fieldcollection();

          for ($i = 0; $i < 5; $i++) {
          $item = new Object\Fieldcollection\Data\Attribute();
          $item->setVal("This is a test " . $i);
          $items->add($item);
          }

          $object->setVal($items);
          $object->save(); */



        /* $newobject->setKey(Pimcore_File::getValidFilename($objectname));
          $newobject->setParentId(5);
          $newobject->setPublished(true);
          $newobject->save();
          $objectid = $newobject->getId();
          $objectObject = Object::getById($objectid);


          $items = new DataObject\Fieldcollection();

          for ($i = 0; $i < 5; $i++) {
          $item = new DataObject\Fieldcollection\Data\Attribute();
          $item->setVal("This is a test " . $i);
          $items->add($item);
          }

          $objectObject->setVal($items);
          $object->save();

          $objectObject->setKey('object-' . $objectid); */


        // echo "<pre>";
        // print_r($new_array);
        /*  $f = fopen(yourfile, "r");
          $fs = filesize(yourfile);
          $content = fread($f, $fs);

          $lines = explode("\n", $content);
          $result = array();
          foreach ($lines as $line)
          $result[] = explode(",", $line);
         * */
    }

}
