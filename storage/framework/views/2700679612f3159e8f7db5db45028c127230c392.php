<?php $__env->startSection('email-body'); ?>

    <tr>
        <td class="body" width="100%" cellpadding="0" cellspacing="0">
            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                <!-- Body content -->
                <tr>
                    <td class="content-cell">

                        <h1 class="greet-ok">Dear <?php echo e($name); ?></h1>

                        <p>Please find a request for parts wanted. Please click on the link below to view the parts and quote.</p><br/>
                        <p>Please quote only on parts available. (attach a photo of sample when available) Click Remove 
						Part when not available.  Keep in mind this quote will expire in 48 hours.</p>
                        <br/>
						<a href="<?php echo e($link); ?>">Quote Now</a>
						<br/>
                        <p>This is an automated e-mail, Please do not reply to this e-mail.</p>
						<br/>
						<p>
							Regards,<br>
                            <?php echo e(getApplicationName()); ?> Team
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('e_mail.layout.email_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>