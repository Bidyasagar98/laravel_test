
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Test</title>
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
</head>
<body>
	<div class="container text-white" style="padding-top: 5%;">
		<div class="card w-75 mt-3 text-white">
			<div class="card-header">
				<?php if($errors->any()): ?>
				<div class="alert alert-danger">
					<ul>
						<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li><?php echo e($error); ?></li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</div>
				<?php endif; ?>

				<?php if(session()->has('success')): ?>
				<div class="alert alert-success">
					<i class="icon-check1" aria-hidden="true"></i> <?php echo e(session('success')); ?>

				</div>
				<?php endif; ?>
				<h3>File Convert</h3>
			</div>
			<div class="card-body" >
				<form method="post" method="post" id="uploadForm" action="/upload" enctype="multipart/form-data" files="true">
					<?php echo csrf_field(); ?>
					<div class="form-group row">
						<label class="col-md-3" for="txtName">Name</label>
						<div class="col-md-7">
							<input type="txtName" name="txtName" class="form-control" id="txtName" value="<?php echo e(old('txtName')); ?>" autocomplete="off" autofocus>
							<?php $__errorArgs = ['txtName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
							<span class="text-danger"><?php echo e($message); ?></span>
							<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
						</div>	
					</div>
					<div class="form-group row">
						<label class="col-md-3" for="file1">File</label>
						<div class="col-md-7">
							<input class="form-control" type="file" name="file1" id="file1" accept="application/msword,
  application/vnd.openxmlformats-officedocument.wordprocessingml.document" onchange="readURL()" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3"></label>
						<div class="col-md-7">
							<button type="submit" name="btnSubmit" class="btn btn-primary" value="Submit" onclick="return validator()">Submit</button>
							<button type="reset" class="btn btn-danger" >Reset</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
		<script>
			function validator()
			{
				if($('#txtName').val()=='')
				{
					alert('Enter Name');
					return false;
				}
				
			}
			function readURL()
			{
				var ext = $('#file1').val().split(".").pop().toLowerCase();
				if($.inArray(ext, ["doc",'docx']) == -1) {
		            alert("Invalid file type");
		            $('#file1').val('');
		            return false;
        		}else{
            		return true;
        		}
				
				return true;
			}
		</script>
	
</body>
</html><?php /**PATH D:\Test_C\resources\views/FileUpload.blade.php ENDPATH**/ ?>