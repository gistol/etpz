<?php
if ($this->pageCount > 1) :
    if ($this->pageCount):
        ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="pagination">
                        <?php if (isset($this->previous)): ?>
                            <li class="prev"><a href="<?= $this->url(['page' => $this->previous]); ?>">Prev</a></li>
                        <?php endif; ?>
                        <?php
                        foreach ($this->pagesInRange as $page) :
                            if ($page == $this->current) :
                                ?>
                                <li class="active"><?= $page ?></li>
                                <?php
                            endif;
                        endforeach;
                        ?>
                        <li><?= count($this->pagesInRange) ?></li>
                        <?php if (isset($this->next)): ?>
                            <li class="next"><a href="<?= $this->url(['page' => $this->next]); ?>">Next</a></li>
                            <?php endif; ?>
                    </ul> 
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->
    <?php endif; ?>
<?php endif; ?>




