<?php $__env->startSection('links'); ?>
    <link rel="stylesheet" type="text/css" href=" <?php echo e(asset('css/home_style.css')); ?> ">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript" src=" <?php echo e(asset('js/home_script.js')); ?> "></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('navbar'); ?>
    <li>
        <!--<a href="/posts">Posts</a>-->
        <form action="/posts/<?php echo e(Auth::user()['id']); ?>" method="GET">
            <button type="submit" class="all_post_button">Posts</button>
            <?php echo e(csrf_field()); ?>

        </form>
    </li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="container">
    
<!--
    <div class="row">
        <div class="col-sm-4">
            <form action="/imageupload" method="post">
                <?php echo e(csrf_field()); ?>

                <input type="file" name="img">
                <button type="submit">Add photo</button>
            </form>
        </div>
    </div>
-->



    <div class="row">

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Categories</div>
                <div class="panel-body">
                    <div>
                        <form action="/category" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <input type="text" name="categoryName" required>
                            <button type="submit" class="btn btn-primary">Add A New Category</button>
                        </form>
                    </div>
                    <ul class="list-group">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <li class="list-group-item"> 
                                <form action="/home/<?php echo e($category->id); ?>" method="GET" style="display:inline">
                                    <button type="submit" class="btn btn-primary catButt"><?php echo e($category->category); ?></button>
                                </form>
                                <form action="/category/<?php echo e($category->id); ?>" method="POST" class="pull-right" style="display:inline">
                                     <?php echo e(csrf_field()); ?>

                                     <?php echo e(method_field('Delete')); ?>

                                     <button type="submit" class="btn btn-danger btn_del">Delete</button>
                                </form>
                                <form  class="pull-right" style="display:inline">
                                        <!--<input type="hidden" name="_method" value="PUT"> -->
                                        <input type="hidden" name="hidId" value="<?php echo e($category->id); ?>" class="hidCatId">
                                        <button type="button" class="btn btn-warning edit_cat">Edit</button>
                                        <?php echo e(method_field('PUT')); ?>

                                        <?php echo e(csrf_field()); ?>

                                </form>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>

        <?php if(isset($posts)): ?>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Posts</div>

                <div class="panel-body">

                    <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div>
                        <form action="/home" method="POST">
                            <div class="form-group col-sm-3">
                                <input type="text" name="post_topic" class="form-control" placeholder="Post Title..." required>
                            </div>
                            <input type="hidden" name="categories_id" value="<?php echo e($cat_id); ?>">
                            <div class="form-group col-sm-4">
                                <textarea name="post" rows="2" col="6" required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add a new post</button>
                            </div>
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </div>
                      <ul class="list-group">
                            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item" style="text-align:left">
                                    <p class="post_p">
                                        <strong><span class="post_topic"><?php echo e($post->post_topic); ?></span></strong>
                                        <span class="post"><?php echo e($post->post); ?></span>
                                    </p>
                                    <form action="/home/<?php echo e($post->id); ?>" method="POST" class="pull-right del_form" style="display:inline">
                                        <?php echo e(csrf_field()); ?>

                                        <?php echo e(method_field('Delete')); ?>

                                        <button class="btn btn-danger delete">Delete</button>
                                    </form> 
                                    <form  class="pull-right" style="display:inline">
                                        <!--<input type="hidden" name="_method" value="PUT"> -->
                                        <input type="hidden" name="hidId" class="hidPostId" value="<?php echo e($post->id); ?>">
                                        <button type="button" class="btn btn-warning edit">Edit</button>
                                        <?php echo e(method_field('PUT')); ?>

                                        <?php echo e(csrf_field()); ?>

                                    </form>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
             </div>            
        </div>           
      <?php endif; ?>          
                
                
 </div>
                

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>