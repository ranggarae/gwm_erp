<?php echo e(Form::open(array('url'=>'transfer','method'=>'post'))); ?>

<div class="modal-body">

    <div class="row">
        <div class="form-group col-lg-6 col-md-6">
            <?php echo e(Form::label('employee_id', __('Employee'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('employee_id', $employees,null, array('class' => 'form-control select','required'=>'required'))); ?>

        </div>
        <div class="form-group col-lg-6 col-md-6">
            <?php echo e(Form::label('branch_id',__('Branch'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('branch_id',$branches,null,array('class'=>'form-control select'))); ?>

        </div>
        <div class="form-group col-lg-6 col-md-6">
            <?php echo e(Form::label('department_id',__('Department'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('department_id',$departments,null,array('class'=>'form-control select'))); ?>

        </div>
        <div class="form-group col-lg-6 col-md-6">
            <?php echo e(Form::label('transfer_date',__('Transfer Date'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('transfer_date',null,array('class'=>'form-control '))); ?>

        </div>
        <div class="form-group col-lg-12">
            <?php echo e(Form::label('description',__('Description'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description')))); ?>

        </div>
    
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>

    <?php echo e(Form::close()); ?>

    <?php /**PATH /home/gitawaha/erp.gitawahanamandiri.com/resources/views/transfer/create.blade.php ENDPATH**/ ?>