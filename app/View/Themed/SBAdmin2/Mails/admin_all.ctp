<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <?php  echo $this->element('breadcrumbs', array('data' => $this->Breadcrumb->buildFromURI(array(0 => '', 1 => $pluralName, 2 => __('Create %s', $singularName))))); ?>
        </div>
    </div>
    <div id="page" class="dashboard">
        <?php echo $this->element('flash_message'); ?>
        <div class="row-fluid ">
            <div class="span12">
                <div class="widget">
                    <div class="widget-body">
                        <?php echo $this->element('search');?>
                        <div class="row-fluid">
                            <div class="span12">
                                <!--BEGIN TABS-->
                                <div class="table table-custom">
                                    <?php echo $this->element('tabs');?>
                                    <div class="tab-content">
                                        <?php echo __('Write promotion letter to all user. Messages will arrive to users email addresses.'); ?>
                                        <br><br>
                                        <?php echo $this->Form->create(); ?>
                                        <?php echo $this->Form->input('subject', array('label' => __('Subject:', true), 'class' => 'input-big')); ?>
                                        <?php echo $this->Form->input('content', array('label' =>  __('Content:', true), 'type' => 'textarea', 'class' => 'span12 ckeditor')); ?>
                                        <br />
                                        <?php echo $this->Form->submit(__('Send', true), array('class' => 'btn')); ?>
                                        <?php echo $this->Form->end(); ?>	
                                        <?php echo $this->Form->create('Download'); ?>
                                        <?php echo $this->Form->input('download', array('value' => '1', 'type' => 'hidden')); ?>
                                        <?php echo $this->Form->submit(__('Download all e-Mails (csv file)', true), array('class' => 'btn btn-danger', 'div' => false, 'style' => 'margin-top: 15px;')); ?>
                                        <?php echo $this->Form->end(); ?>
                                    </div>
                                </div>
                                <!--END TABS-->
                            </div>
                            <div class="space10 visible-phone"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>