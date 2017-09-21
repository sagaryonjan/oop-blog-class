<?php
require 'helper/Session.php';
new Session();

require 'class/Category.php';

$category = new Category();
$datas = $category->lists();

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $category->destroy($_POST);

}

/*
if( isset($_GET['action'])  && $_GET['action'] == 'delete' ) {

    if( isset($_GET['id']) ) {

        if(!$user->edit($_GET['id'])) {
            header('location:404.php');
            exit;
        }

        $messages = [];

        if( $user->delete($_GET['id']) ) {
            $messages['success'] =  'Your record has been deleted succeessfully';
        } else {
            $messages['success'] =  'Something went wrong!!';
        }

        header('location:users.php');

    }
}*/


$path = 'public/'; ?>

    <!DOCTYPE html>
    <html lang="en">

    <?php include 'includes/head.php'; ?>

    <body class="no-skin">

    <?php include 'includes/navbar.php'; ?>


    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.loadState('main-container')
            } catch (e) {
            }
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
                        <li class="active">Category</li>
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
                            Category
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                List
                            </small>

                            <a href="category_add.php">
                                <button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Category</button>
                            </a>
                        </h1>
                    </div><!-- /.page-header -->

                    <div class="row">


                        <?php
                        if(Session::get('message')) {
                            echo Session::get('message');
                            Session::remove('message');
                        }
                        ?>


                        <?php if(isset($messages['error'])): ?>
                            <div class="alert alert-block alert-danger">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="ace-icon fa fa-times"></i>
                                </button>

                                <i class="ace-icon fa fa-check green"></i>

                                <?php echo $messages['error']; ?>
                            </div>
                        <?php endif; ?>

                        <div class="col-xs-12">
                            <table id="simple-table" class="table  table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">
                                        <label class="pos-rel">
                                            <input type="checkbox" class="ace">
                                            <span class="lbl"></span>
                                        </label>
                                    </th>
                                    <th>Title</th>
                                    <th >Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                <?php foreach ($datas as $data) : ?>

                                    <tr>
                                        <td class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace">
                                                <span class="lbl"></span>
                                            </label>
                                        </td>

                                        <td width="25%">
                                            <?php echo $data['title']; ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($data['status'] == 1) :
                                                ?>
                                                <span class="label label-success arrowed-in arrowed-in-right">active</span>
                                                <?php
                                            else:
                                                ?>
                                                <span class="label label-warning arrowed-in arrowed-in-right">inactive</span>
                                                <?php
                                            endif;
                                            ?>

                                        </td>


                                        <td>
                                            <div class="hidden-sm hidden-xs btn-group">

                                                <a href="category_edit.php?id=<?php echo $data['id']; ?>">
                                                    <button class="btn btn-xs btn-info">
                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                    </button>
                                                </a>

                                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                                    <input type="hidden" name="_method" value="DELETE">

                                                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

                                                    <button type="submit" class="btn btn-xs btn-danger">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                    </button>

                                                </form>

                                            </div>

                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div><!-- /.col -->
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


<?php
