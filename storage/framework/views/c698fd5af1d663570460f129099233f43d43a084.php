<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Posts</div>

                <div class="panel-body">

                    <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


                    <form action="/home" method="post" class="form-horizontal">
                        <div class="form-group col-sm-6">
                            <input type="text" name="postTitle" class="form-control" placeholder="Post Title...">
                        </div>
                        <div class="form-group col-sm-4">
                            <textarea name="postBody" rows="4" col="6"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <?php echo e(csrf_field()); ?>

                    </form>
                </div>

               
                 <!--<p><?php echo e($posts); ?></p>-->
                
                <ul class="list-group">
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item">
                            <?php echo e($post['post_topic']); ?> 
                            <form action="/home/<?php echo e($post->id); ?>" method="post" class="pull-right">
                                <?php echo e(csrf_field()); ?>

                                <?php echo e(method_field('Delete')); ?>

                                <button class="btn btn-warning">Delete</button>
                            </form> 
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

                <?php echo e(Auth::user()); ?>


            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>