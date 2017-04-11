<?php $__env->startSection('content'); ?>
<div class="container">
    
<!--
    <div class="row">
        <div class="col-sm-4">
            <form action="/imageupload" method="post">
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
                    <div class="">
                        <form action="/category" method="post">
                            <input type="text" name="categoryName" required>
                            <button type="submit" class="btn btn-primary">Add A New Category</button>
                        </form>
                    </div>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($category->category); ?>  <br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Posts</div>

                <div class="panel-body">

                    <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <form action="/home" method="post" class="col-sm-10">
                        <div class="form-group col-sm-3">
                            <input type="text" name="postTitle" class="form-control" placeholder="Post Title...">
                        </div>
                        <div class="form-group col-sm-6">
                            <textarea name="postBody" rows="2" col="6"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <?php echo e(csrf_field()); ?>

                    </form>
                </div>
        </div>            
    </div>           
                
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

                <!-- <?php echo e(Auth::user()['id']); ?> -->
        </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>