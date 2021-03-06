<?php

require_once 'helper/Session.php';

new Session();


require 'class/Category.php';

$category = new Category();
$category_list = $category->categoryList();



if($_SERVER['REQUEST_METHOD'] == 'POST') {


    require 'validation/Post/PostAddFormValidation.php';

    require 'class/Post.php';


    $errors = (new PostAddFormValidation())->rules($_POST);

    if ($errors['validate'] == 1) {


      /*  print_r($_FILES);
        die;*/


       $message = ( new Post() )->insert();

    }

}
 ?>

<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php'; ?>

<body class="no-skin">

<?php include 'includes/navbar.php'; ?>



<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
    </script>

    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>
                    <li class="active"> Post</li>
                </ul><!-- /.breadcrumb -->
            </div>

            <div class="page-content">
                <div class="ace-settings-container" id="ace-settings-container">
                    <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                        <i class="ace-icon fa fa-cog bigger-130"></i>
                    </div>
                </div><!-- /.ace-settings-container -->

                <div class="page-header">
                    <h1>
                         Post
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            List
                        </small>

                        <a href="category.php"> <button class="btn btn-primary"><i class="fa fa-list"></i> Post List</button></a>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->

                        <?php if(isset($message)) : ?>
                            <div class="alert alert-block alert-success">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>

                        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Title </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" name="title"
                                           <?php if(isset($_POST['title'])) : ?>
                                             value="<?php echo $_POST['title']; ?>"
                                           <?php endif; ?>
                                           placeholder="TItle" class="col-xs-10 col-sm-5">

                                    <?php
                                    if(isset($errors['errors']['title'])) {
                                        echo "<span style='color:red;'>".$errors['errors']['title']."</span>";
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Category </label>

                                <div class="col-sm-9">
                                    <select  id="form-field-1" name="category_id" class="col-xs-10 col-sm-5">
                                        <?php foreach ($category_list as $category) : ?>
                                        <option

                                                <?php if(isset($_POST['category_id']) && $_POST['category_id'] == $category['id']) : ?>

                                                selected
                                                <?php endif; ?>

                                                value="<?php echo $category['id'] ?>"
                                        ><?php echo $category['title'] ?></option>
                                        <?php endforeach; ?>

                                        <?php
                                        if(isset($errors['errors']['category_id'])) {
                                            echo "<span style='color:red;'>".$errors['errors']['category_id']."</span>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Image </label>

                                <div class="col-sm-9">
                                    <input type="file" id="form-field-1" name="image" class="col-xs-10 col-sm-5">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status </label>

                                <div class="col-sm-9">
                                    <select  id="form-field-1" name="status"class="col-xs-10 col-sm-5">
                                        <option value="1"
                                            <?php if(isset($_POST['status']) && $_POST['status'] == 1) : ?>
                                                selected
                                            <?php endif; ?>
                                        >Active</option>
                                        <option value="0"
                                            <?php if(isset($_POST['status']) && $_POST['status'] == 0) : ?>
                                                selected
                                            <?php endif; ?>
                                        > InActive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Short Description </label>

                                <?php if(isset($_POST['short_desc'])) :
                                $short_desc = $_POST['short_desc'];
                                else:
                                    $short_desc = '';
                                endif; ?>

                                <div class="col-sm-9">
                                    <textarea  id="form-field-1" name="short_desc"
                                               placeholder="Short Description"
                                               cols="50"
                                               rows="15"
                                               class="col-xs-10 col-sm-5"><?php echo $short_desc; ?></textarea>
                                    <?php
                                    if(isset($errors['errors']['short_desc'])) {
                                        echo "<span style='color:red;'>".$errors['errors']['short_desc']."</span>";
                                    }
                                    ?>

                                </div>
                            </div>

                            <div class="form-group">

                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Long Description </label>

                                <?php if(isset($_POST['long_desc'])) :
                                    $long_desc = $_POST['long_desc'];
                                else:
                                    $long_desc = '';
                                endif; ?>

                                <div class="col-sm-9">
                                    <textarea  id="form-field-1" name="long_desc"
                                               placeholder="Long Description"
                                               cols="50"
                                               rows="15"
                                               class="col-xs-10 col-sm-5"><?php echo $long_desc; ?></textarea>

                                </div>
                            </div>


                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-info" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        Submit
                                    </button>

                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn" type="reset">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->

    <?php include 'includes/footer.php'; ?>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->

<!-- basic scripts -->


<?php include 'includes/footer.php'; ?>


<?php include 'includes/script.php'; ?>
</body>
</html>
