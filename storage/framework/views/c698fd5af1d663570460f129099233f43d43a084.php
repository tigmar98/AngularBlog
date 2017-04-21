<?php $__env->startSection('links'); ?>
    <link rel="stylesheet" type="text/css" href=" <?php echo e(asset('css/home_style.css')); ?> ">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('navbar'); ?>
    <li>
        <?php echo Form::open(['url' => '/showallposts', 'method' => 'get']); ?>

            <?php echo Form::submit('Posts', array('class' => 'all_post_button')); ?>

        <?php echo Form::close(); ?>

    </li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="container">
        
        <div class="row">
            <div class="col-sm-4">
                <img src="<?php echo e($image_path); ?>" class="profile_pic">
            </div>
        </div>
        <?php echo Form::open(['url' => '/imageuploadform', 'method' => 'get']); ?>

            <?php echo Form::submit('Upload Image'); ?>

        <?php echo Form::close(); ?>



        <div class="row">

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Categories</div>
                    <div class="panel-body">
                        <div>
                            <?php echo Form::open(['url' => '/category']); ?>

                                <?php echo Form::text('categoryName'); ?>

                                <?php echo Form::submit('Add A New Category', array('class' => 'btn btn-success pull-right')); ?>

                                <?php echo e(csrf_field()); ?>

                            <?php echo Form::close(); ?>

                        </div>
                        <ul class="list-group">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <li class="list-group-item"> 
                                    <?php echo Form::open(['url' => '/home/'.$category->id, 'method' => 'get']); ?>

                                        <?php echo Form::submit($category->category, array('class' => 'btn btn-primary catButt')); ?>

                                    <?php echo Form::close(); ?>

                                    <?php echo Form::open(['url' => '/category/'.$category->id, 'method' => 'delete']); ?>

                                        <?php echo Form::submit('Delete', array('class' => 'btn btn-danger pull-right')); ?>

                                        <?php echo e(csrf_field()); ?>

                                    <?php echo Form::close(); ?>

                                    <?php echo Form::open(['url' => '/category/'.$category->id.'/edit', 'method' => 'get']); ?>

                                        <?php echo Form::submit('Edit', array('class' => 'btn btn-warning pull-right')); ?>

                                        <?php echo e(csrf_field()); ?>

                                    <?php echo Form::close(); ?>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <?php if(isset($posts)): ?>
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">Posts</div>

                        <div class="panel-body">
                            <div>
                                <?php echo Form::open(['url' => '/post']); ?>

                                    <?php echo Form::text('post_topic', 'Post Topic...'); ?>

                                    <?php echo Form::text('post', 'Post'); ?>

                                    <?php echo Form::hidden('categories_id', "$cat_id"); ?>

                                    <?php echo Form::submit('Add new post', array('class' => 'btn btn-success')); ?>

                                    <?php echo e(csrf_field()); ?>

                                <?php echo Form::close(); ?> 
                            </div>
                            <ul class="list-group">
                                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item" style="text-align:left">
                                        <p class="post_p">
                                           <strong><span class="post_topic"><?php echo e($post->post_topic); ?></span></strong>
                                           <span class="post"><?php echo e($post->post); ?></span>
                                        </p>
                                              
                                        <?php echo Form::open(['url' => '/post/'.$post->id]); ?>

                                            <?php echo Form::submit('Delete', array('class' => 'btn btn-danger pull-right')); ?>

                                            <?php echo e(method_field('Delete')); ?>

                                            <?php echo e(csrf_field()); ?>

                                        <?php echo Form::close(); ?>


                                        <?php echo Form::open(['url' => '/post/'.$post->id.'/edit', 'method' =>'get']); ?>

                                            <?php echo Form::submit('Show Post', array('class' => 'btn btn-warning pull-right')); ?> 
                                            <?php echo e(csrf_field()); ?>

                                        <?php echo Form::close(); ?>

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