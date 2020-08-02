<!DOCTYPE html>
<html>
    <head>
    <title>Full Calendar CRUD</title>
        <meta charset='utf-8' />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>template/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>template/bootstrap/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/calendar/plugins/fullcalendar/fullcalendar.css">
        <link rel="stylesheet "type="text/css" href="<?php echo base_url() ?>assets/calendar/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
        <link href="<?php echo base_url();?>template/dist/css/bootstrapValidator.min.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>template/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
        <!-- Custom css  -->
        <link href="<?php echo base_url();?>template/dist/css/custom.css" rel="stylesheet" />

        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/calendar/js/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>template/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/calendar/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/calendar/plugins/fullcalendar/fullcalendar.js"></script>
        <script src="<?php echo base_url();?>template/dist/js/bootstrapValidator.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/calendar/plugins/fullcalendar/fullcalendar.min.js"></script>
        <script src='<?php echo base_url();?>template/dist/js/bootstrap-colorpicker.min.js'></script>
        <script src='<?php echo base_url();?>template/dist/js/main.js'></script>

    </head>
    <body>

        <div class="container">
                <!-- Notification -->
                <div class="alert"></div>
            <div class="row clearfix">
                <div class="col-md-12 column">
                        <div id='calendar'></div>
                </div>
            </div>
        </div>
        <div class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="error"></div>
                        <form class="form-horizontal" id="crud-form">
                        <input type="hidden" id="start">
                        <input type="hidden" id="end">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="title">Title</label>
                                <div class="col-md-4">
                                    <input id="title" name="title" type="text" class="form-control input-md" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="description">Description</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="color">Color</label>
                                <div class="col-md-4">
                                    <input id="color" name="color" type="text" class="form-control input-md" readonly="readonly" />
                                    <span class="help-block">Click to pick a color</span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
