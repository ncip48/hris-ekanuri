<?php
    use App\Models\Utility;
    //  $logo=asset(Storage::url('uploads/logo/'));
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $company_logo = Utility::getValByName('company_logo_dark');
    $company_logos = Utility::getValByName('company_logo_light');
    $company_small_logo = Utility::getValByName('company_small_logo');
    $setting = \App\Models\Utility::colorset();
    $mode_setting = \App\Models\Utility::mode_layout();
    $emailTemplate = \App\Models\EmailTemplate::first();
    $lang = Auth::user()->lang;

?>

<?php if(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on'): ?>
    <nav class="dash-sidebar light-sidebar transprent-bg">
    <?php else: ?>
        <nav class="dash-sidebar light-sidebar ">
<?php endif; ?>
<div class="navbar-wrapper">
    <div class="m-header main-logo">
        <a href="#" class="b-brand">
            

            <?php if($mode_setting['cust_darklayout'] && $mode_setting['cust_darklayout'] == 'on'): ?>
                <img src="<?php echo e($logo . '/' . (isset($company_logos) && !empty($company_logos) ? $company_logos : 'logo-dark.png')); ?>"
                    alt="<?php echo e(config('app.name', 'ERPGo-SaaS')); ?>" class="logo logo-lg">
            <?php else: ?>
                <img src="<?php echo e($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png')); ?>"
                    alt="<?php echo e(config('app.name', 'ERPGo-SaaS')); ?>" class="logo logo-lg">
            <?php endif; ?>

        </a>
    </div>
    <div class="navbar-content">
        <?php if(\Auth::user()->type != 'client'): ?>
            <ul class="dash-navbar">
                <!--------------------- Start Dashboard ----------------------------------->
                <?php if( Gate::check('show hrm dashboard') || Gate::check('show project dashboard') || Gate::check('show account dashboard') || Gate::check('show crm dashboard') || Gate::check('show pos dashboard')): ?>
                        <li class="dash-item dash-hasmenu
                                <?php echo e(( Request::segment(1) == null ||Request::segment(1) == 'account-dashboard' || Request::segment(1) == 'income report'
                                   || Request::segment(1) == 'report' || Request::segment(1) == 'reports-monthly-cashflow' || Request::segment(1) == 'reports-quarterly-cashflow' || Request::segment(1) == 'reports-payroll' || Request::segment(1) == 'reports-leave'
                                   || Request::segment(1) == 'reports-monthly-attendance' || Request::segment(1) == 'reports-lead' || Request::segment(1) == 'reports-deal'
                                   || Request::segment(1) == 'pos-dashboard'|| Request::segment(1) == 'reports-warehouse' || Request::segment(1) == 'reports-daily-purchase'
                                   || Request::segment(1) == 'reports-monthly-purchase' || Request::segment(1) == 'reports-daily-pos' ||Request::segment(1) == 'reports-monthly-pos' ||Request::segment(1) == 'reports-pos-vs-purchase') ?'active dash-trigger':''); ?>">
                                <a href="#!" class="dash-link ">
                                    <span class="dash-micon">
                                        <i class="ti ti-home"></i>
                                    </span>
                                    <span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                                    <span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                    <ul class="dash-submenu">
                                        

                                        <?php if(\Auth::user()->show_hrm() == 1): ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show hrm dashboard')): ?>
                                                    <li class="dash-item dash-hasmenu <?php echo e(( Request::segment(1) == 'hrm-dashboard'   || Request::segment(1) == 'reports-payroll') ? ' active dash-trigger' : ''); ?>">
                                                        <a class="dash-link" href="#"><?php echo e(__('HRM ')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                                        <ul class="dash-submenu">
                                                            <li class="dash-item <?php echo e((\Request::route()->getName()=='hrm.dashboard') ? ' active' : ''); ?>">
                                                                <a class="dash-link" href="<?php echo e(route('hrm.dashboard')); ?>"><?php echo e(__(' Overview')); ?></a>
                                                            </li>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage report')): ?>
                                                                <li class="dash-item dash-hasmenu
                                                                    <?php echo e((Request::segment(1) == 'reports-monthly-attendance' || Request::segment(1) == 'reports-leave'
                                                                    || Request::segment(1) == 'reports-payroll') ? 'active dash-trigger' : ''); ?>"
                                                                    href="#hr-report" data-toggle="collapse" role="button"
                                                                    aria-expanded="<?php echo e((Request::segment(1) == 'reports-monthly-attendance' || Request::segment(1) == 'reports-leave' || Request::segment(1) == 'reports-payroll') ? 'true' : 'false'); ?>">
                                                                    <a class="dash-link" href="#"><?php echo e(__('Reports')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                                                    <ul class="dash-submenu">
                                                                        <li class="dash-item <?php echo e(request()->is('reports-payroll') ? 'active' : ''); ?>">
                                                                            <a class="dash-link" href="<?php echo e(route('report.payroll')); ?>"><?php echo e(__('Payroll')); ?></a>
                                                                        </li>
                                                                        <li class="dash-item <?php echo e(request()->is('reports-leave') ? 'active' : ''); ?>">
                                                                            <a class="dash-link" href="<?php echo e(route('report.leave')); ?>"><?php echo e(__('Leave')); ?></a>
                                                                        </li>
                                                                        <li class="dash-item <?php echo e(request()->is('reports-monthly-attendance') ? 'active' : ''); ?>">
                                                                            <a class="dash-link" href="<?php echo e(route('report.monthly.attendance')); ?>"><?php echo e(__('Monthly Attendance')); ?></a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            

                                            

                                            

                                    </ul>
                        </li>
                    <?php endif; ?>


                <!--------------------- Start HRM ----------------------------------->

                <?php if(\Auth::user()->show_hrm() == 1): ?>
                    <?php if(Gate::check('manage employee') || Gate::check('manage setsalary')): ?>
                        <li
                            class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'holiday-calender' ||
                            Request::segment(1) == 'leavetype' ||
                            Request::segment(1) == 'leave' ||
                            Request::segment(1) == 'attendanceemployee' ||
                            Request::segment(1) == 'document-upload' ||
                            Request::segment(1) == 'document' ||
                            Request::segment(1) == 'performanceType' ||
                            Request::segment(1) == 'branch' ||
                            Request::segment(1) == 'department' ||
                            Request::segment(1) == 'designation' ||
                            Request::segment(1) == 'employee' ||
                            Request::segment(1) == 'leave_requests' ||
                            Request::segment(1) == 'holidays' ||
                            Request::segment(1) == 'policies' ||
                            Request::segment(1) == 'leave_calender' ||
                            Request::segment(1) == 'award' ||
                            Request::segment(1) == 'transfer' ||
                            Request::segment(1) == 'resignation' ||
                            Request::segment(1) == 'training' ||
                            Request::segment(1) == 'travel' ||
                            Request::segment(1) == 'promotion' ||
                            Request::segment(1) == 'complaint' ||
                            Request::segment(1) == 'warning' ||
                            Request::segment(1) == 'termination' ||
                            Request::segment(1) == 'announcement' ||
                            Request::segment(1) == 'job' ||
                            Request::segment(1) == 'job-application' ||
                            Request::segment(1) == 'candidates-job-applications' ||
                            Request::segment(1) == 'job-onboard' ||
                            Request::segment(1) == 'custom-question' ||
                            Request::segment(1) == 'interview-schedule' ||
                            Request::segment(1) == 'career' ||
                            Request::segment(1) == 'holiday' ||
                            Request::segment(1) == 'setsalary' ||
                            Request::segment(1) == 'payslip' ||
                            Request::segment(1) == 'paysliptype' ||
                            Request::segment(1) == 'company-policy' ||
                            Request::segment(1) == 'job-stage' ||
                            Request::segment(1) == 'job-category' ||
                            Request::segment(1) == 'terminationtype' ||
                            Request::segment(1) == 'awardtype' ||
                            Request::segment(1) == 'trainingtype' ||
                            Request::segment(1) == 'goaltype' ||
                            Request::segment(1) == 'paysliptype' ||
                            Request::segment(1) == 'allowanceoption' ||
                            Request::segment(1) == 'competencies' ||
                            Request::segment(1) == 'loanoption' ||
                            Request::segment(1) == 'deductionoption'
                                ? 'active dash-trigger'
                                : ''); ?>">
                            <a href="#!" class="dash-link ">
                                <span class="dash-micon">
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="dash-mtext">
                                    <?php echo e(__('HRM System')); ?>

                                </span>
                                <span class="dash-arrow">
                                    <i data-feather="chevron-right"></i>
                                </span>
                            </a>
                            <ul class="dash-submenu">
                                
                                <li
                                    class="dash-item  <?php echo e(Request::segment(1) == 'employee' ? 'active dash-trigger' : ''); ?>   ">
                                    <?php if(\Auth::user()->type == 'Employee'): ?>
                                        <?php
                                            $employee = App\Models\Employee::where('user_id', \Auth::user()->id)->first();
                                        ?>
                                        <a class="dash-link"
                                            href="<?php echo e(route('employee.show', \Illuminate\Support\Facades\Crypt::encrypt($employee->id))); ?>"><?php echo e(__('Employee')); ?></a>
                                    <?php else: ?>
                                        
                                        <?php if(Gate::check('manage personal report')): ?>
                                            
                                            <a class="dash-link" href="#"><?php echo e(__('Employee Setup')); ?><span
                                                    class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                            <ul class="dash-submenu">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage personal report')): ?>
                                                    <li
                                                        class="dash-item <?php echo e(request()->is('personal-report*') ? 'active' : ''); ?>">
                                                        <a class="dash-link"
                                                            href="<?php echo e(route('personal-report.index')); ?>"><?php echo e(__('Personal Report')); ?></a>
                                                    </li>
                                                    <li
                                                        class="dash-item <?php echo e(request()->is('request edit identitas*') ? 'active' : ''); ?>">
                                                        <a class="dash-link" href=""><?php echo e(__('Edit Identitas')); ?></a>
                                                    </li>
                                                    <li
                                                        class="dash-item <?php echo e(request()->is('employee setup*') ? 'active' : ''); ?>">
                                                        <a class="dash-link" href="<?php echo e(route('employee.index')); ?>"><?php echo e(__('Employee Setup')); ?></a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                            
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </li>

                                <?php if(Gate::check('manage set salary') || Gate::check('manage pay slip')): ?>
                                    <li
                                        class="dash-item dash-hasmenu  <?php echo e(Request::segment(1) == 'setsalary' || Request::segment(1) == 'payslip' ? 'active dash-trigger' : ''); ?>">
                                        <a class="dash-link" href="#"><?php echo e(__('Payroll Setup')); ?><span
                                                class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage set salary')): ?>
                                                <li class="dash-item <?php echo e(request()->is('setsalary*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('setsalary.index')); ?>"><?php echo e(__('Set salary')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage pay slip')): ?>
                                                <li class="dash-item <?php echo e(request()->is('payslip*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('payslip.index')); ?>"><?php echo e(__('Payslip')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>

                                <?php if(Gate::check('manage leave') || Gate::check('manage attendance')): ?>
                                    <li
                                        class="dash-item dash-hasmenu  <?php echo e(Request::segment(1) == 'leave' || Request::segment(1) == 'attendanceemployee' ? 'active dash-trigger' : ''); ?>">
                                        <a class="dash-link" href="#"><?php echo e(__('Leave Management Setup')); ?><span
                                                class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage leave')): ?>
                                                <li
                                                    class="dash-item <?php echo e(Request::route()->getName() == 'leave.index' ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('leave.index')); ?>"><?php echo e(__('Manage Leave')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage attendance')): ?>
                                                <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'attendanceemployee' ? 'active dash-trigger' : ''); ?>"
                                                    href="#navbar-attendance" data-toggle="collapse" role="button"
                                                    aria-expanded="<?php echo e(Request::segment(1) == 'attendanceemployee' ? 'true' : 'false'); ?>">
                                                    <a class="dash-link" href="#"><?php echo e(__('Attendance')); ?><span
                                                            class="dash-arrow"><i
                                                                data-feather="chevron-right"></i></span></a>
                                                    <ul class="dash-submenu">
                                                        <li
                                                            class="dash-item <?php echo e(Request::route()->getName() == 'attendanceemployee.index' ? 'active' : ''); ?>">
                                                            <a class="dash-link"
                                                                href="<?php echo e(route('attendanceemployee.index')); ?>"><?php echo e(__('Mark Attendance')); ?></a>
                                                        </li>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create attendance')): ?>
                                                            <li
                                                                class="dash-item <?php echo e(Request::route()->getName() == 'attendanceemployee.bulkattendance' ? 'active' : ''); ?>">
                                                                <a class="dash-link"
                                                                    href="<?php echo e(route('attendanceemployee.bulkattendance')); ?>"><?php echo e(__('Bulk Attendance')); ?></a>
                                                            </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>

                                <?php if(Gate::check('manage indicator') ||
                                        Gate::check('manage appraisal') ||
                                        Gate::check('manage goal tracking') ||
                                        Gate::check('manage behavior') ||
                                        Gate::check('manage rating behavior')): ?>
                                    <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'indicator' || Request::segment(1) == 'appraisal' || Request::segment(1) == 'goaltracking' || Request::segment(1) == 'behavior' || Request::segment(1) == 'rating-behavior' ? 'active dash-trigger' : ''); ?>"
                                        href="#navbar-performance" data-toggle="collapse" role="button"
                                        aria-expanded="<?php echo e(Request::segment(1) == 'indicator' || Request::segment(1) == 'appraisal' || Request::segment(1) == 'goaltracking' || Request::segment(1) == 'behavior' || Request::segment(1) == 'rating-behavior' ? 'true' : 'false'); ?>">
                                        <a class="dash-link" href="#"><?php echo e(__('Performance Setup')); ?><span
                                                class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul
                                            class="dash-submenu <?php echo e(Request::segment(1) == 'indicator' || Request::segment(1) == 'appraisal' || Request::segment(1) == 'goaltracking' || Request::segment(1) == 'behavior' || Request::segment(1) == 'rating-behavior' ? 'show' : 'collapse'); ?>">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage indicator')): ?>
                                                <li class="dash-item <?php echo e(request()->is('indicator*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('indicator.index')); ?>"><?php echo e(__('Indicator')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage appraisal')): ?>
                                                <li class="dash-item <?php echo e(request()->is('appraisal*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('appraisal.index')); ?>"><?php echo e(__('Appraisal')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage goal tracking')): ?>
                                                <li
                                                    class="dash-item  <?php echo e(request()->is('goaltracking*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('goaltracking.index')); ?>"><?php echo e(__('Goal Tracking')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage behavior')): ?>
                                                <li class="dash-item  <?php echo e(request()->is('behavior*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('behavior.index')); ?>"><?php echo e(__('Behavior')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage rating behavior')): ?>
                                                <li
                                                    class="dash-item  <?php echo e(request()->is('rating-behavior*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('rating-behavior.index')); ?>"><?php echo e(__('Rating Behavior')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>

                                <?php if(Gate::check('manage training') || Gate::check('manage trainer') || Gate::check('show training')): ?>
                                    <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'trainer' || Request::segment(1) == 'training' ? 'active dash-trigger' : ''); ?>"
                                        href="#navbar-training" data-toggle="collapse" role="button"
                                        aria-expanded="<?php echo e(Request::segment(1) == 'trainer' || Request::segment(1) == 'training' ? 'true' : 'false'); ?>">
                                        <a class="dash-link" href="#"><?php echo e(__('Training Setup')); ?><span
                                                class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage training')): ?>
                                                <li class="dash-item <?php echo e(request()->is('training*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('training.index')); ?>"><?php echo e(__('Training List')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage trainer')): ?>
                                                <li class="dash-item <?php echo e(request()->is('trainer*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('trainer.index')); ?>"><?php echo e(__('Trainer')); ?></a>
                                                </li>
                                            <?php endif; ?>

                                        </ul>
                                    </li>
                                <?php endif; ?>

                                <?php if(Gate::check('manage job') ||
                                        Gate::check('create job') ||
                                        Gate::check('manage job application') ||
                                        Gate::check('manage custom question') ||
                                        Gate::check('show interview schedule') ||
                                        Gate::check('show career')): ?>
                                    <li
                                        class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'job' || Request::segment(1) == 'job-application' || Request::segment(1) == 'candidates-job-applications' || Request::segment(1) == 'job-onboard' || Request::segment(1) == 'custom-question' || Request::segment(1) == 'interview-schedule' || Request::segment(1) == 'career' ? 'active dash-trigger' : ''); ?>    ">
                                        <a class="dash-link" href="#"><?php echo e(__('Recruitment Setup')); ?><span
                                                class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job')): ?>
                                                <li
                                                    class="dash-item <?php echo e(Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show' ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('job.index')); ?>"><?php echo e(__('Jobs')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create job')): ?>
                                                <li
                                                    class="dash-item <?php echo e(Request::route()->getName() == 'job.create' ? 'active' : ''); ?> ">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('job.create')); ?>"><?php echo e(__('Job Create')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job application')): ?>
                                                <li
                                                    class="dash-item <?php echo e(request()->is('job-application*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('job-application.index')); ?>"><?php echo e(__('Job Application')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job application')): ?>
                                                <li
                                                    class="dash-item <?php echo e(request()->is('candidates-job-applications') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('job.application.candidate')); ?>"><?php echo e(__('Job Candidate')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job application')): ?>
                                                <li
                                                    class="dash-item <?php echo e(request()->is('job-onboard*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('job.on.board')); ?>"><?php echo e(__('Job On-boarding')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage custom question')): ?>
                                                <li
                                                    class="dash-item  <?php echo e(request()->is('custom-question*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('custom-question.index')); ?>"><?php echo e(__('Custom Question')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show interview schedule')): ?>
                                                <li
                                                    class="dash-item <?php echo e(request()->is('interview-schedule*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('interview-schedule.index')); ?>"><?php echo e(__('Interview Schedule')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show career')): ?>
                                                <li class="dash-item <?php echo e(request()->is('career*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('career', [\Auth::user()->creatorId(), $lang])); ?>"><?php echo e(__('Career')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>

                                <?php if(Gate::check('manage award') ||
                                        Gate::check('manage transfer') ||
                                        Gate::check('manage resignation') ||
                                        Gate::check('manage travel') ||
                                        Gate::check('manage promotion') ||
                                        Gate::check('manage complaint') ||
                                        Gate::check('manage warning') ||
                                        Gate::check('manage termination') ||
                                        Gate::check('manage announcement') ||
                                        Gate::check('manage holiday') ||
                                        Gate::check('manage kontrak')): ?>
                                    <li
                                        class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'holiday-calender' || Request::segment(1) == 'holiday' || Request::segment(1) == 'policies' || Request::segment(1) == 'award' || Request::segment(1) == 'transfer' || Request::segment(1) == 'resignation' || Request::segment(1) == 'travel' || Request::segment(1) == 'promotion' || Request::segment(1) == 'complaint' || Request::segment(1) == 'warning' || Request::segment(1) == 'termination' || Request::segment(1) == 'announcement' || Request::segment(1) == 'competencies' ? 'active dash-trigger' : ''); ?>">
                                        <a class="dash-link" href="#"><?php echo e(__('HR Admin Setup')); ?><span
                                                class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage award')): ?>
                                                <li class="dash-item <?php echo e(request()->is('award*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('award.index')); ?>"><?php echo e(__('Award')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage transfer')): ?>
                                                <li class="dash-item  <?php echo e(request()->is('transfer*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('transfer.index')); ?>"><?php echo e(__('Transfer')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage resignation')): ?>
                                                <li
                                                    class="dash-item <?php echo e(request()->is('resignation*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('resignation.index')); ?>"><?php echo e(__('Resignation')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage travel')): ?>
                                                <li class="dash-item <?php echo e(request()->is('travel*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('travel.index')); ?>"><?php echo e(__('Trip')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage promotion')): ?>
                                                <li class="dash-item <?php echo e(request()->is('promotion*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('promotion.index')); ?>"><?php echo e(__('Promotion')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage complaint')): ?>
                                                <li class="dash-item <?php echo e(request()->is('complaint*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('complaint.index')); ?>"><?php echo e(__('Complaints')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage warning')): ?>
                                                <li class="dash-item <?php echo e(request()->is('warning*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('warning.index')); ?>"><?php echo e(__('Warning')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage termination')): ?>
                                                <li
                                                    class="dash-item <?php echo e(request()->is('termination*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('termination.index')); ?>"><?php echo e(__('Termination')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage announcement')): ?>
                                                <li
                                                    class="dash-item <?php echo e(request()->is('announcement*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('announcement.index')); ?>"><?php echo e(__('Announcement')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage holiday')): ?>
                                                <li
                                                    class="dash-item <?php echo e(request()->is('holiday*') || request()->is('holiday-calender') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('holiday.index')); ?>"><?php echo e(__('Holidays')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage event')): ?>
                                    <li class="dash-item <?php echo e(request()->is('event*') ? 'active' : ''); ?>">
                                        <a class="dash-link"
                                            href="<?php echo e(route('event.index')); ?>"><?php echo e(__('Event Setup')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage meeting')): ?>
                                    <li class="dash-item <?php echo e(request()->is('meeting*') ? 'active' : ''); ?>">
                                        <a class="dash-link"
                                            href="<?php echo e(route('meeting.index')); ?>"><?php echo e(__('Meeting')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage assets')): ?>
                                    <li class="dash-item <?php echo e(request()->is('account-assets*') ? 'active' : ''); ?>">
                                        <a class="dash-link"
                                            href="<?php echo e(route('account-assets.index')); ?>"><?php echo e(__('Employees Asset Setup ')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage document')): ?>
                                    <li class="dash-item <?php echo e(request()->is('document-upload*') ? 'active' : ''); ?>">
                                        <a class="dash-link"
                                            href="<?php echo e(route('document-upload.index')); ?>"><?php echo e(__('Document Setup')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(Gate::check('manage kontrak') || Gate::check('manage extend contract')): ?>
                                    <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'kontrak' ? 'active dash-trigger' : ''); ?>"
                                        href="#navbar-training" data-toggle="collapse" role="button"
                                        aria-expanded="<?php echo e(Request::segment(1) == 'kontrak' ? 'true' : 'false'); ?>">
                                        <a class="dash-link" href="#"><?php echo e(__('Employees Contract')); ?><span
                                                class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage extended contract')): ?>
                                                <li class="dash-item <?php echo e(request()->is('extend-contract*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('extend-contract.index')); ?>"><?php echo e(__('Extend Contract')); ?></a>
                                                </li>                                                
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage kontrak')): ?>
                                                <li class="dash-item <?php echo e(request()->is('kontrak*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('employee-contract.index')); ?>"><?php echo e(__('Contract')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage company policy')): ?>
                                    <li class="dash-item <?php echo e(request()->is('company-policy*') ? 'active' : ''); ?>">
                                        <a class="dash-link"
                                            href="<?php echo e(route('company-policy.index')); ?>"><?php echo e(__('Company policy')); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(\Auth::user()->type == 'company' || \Auth::user()->type == 'HR'): ?>
                                    <li
                                        class="dash-item <?php echo e(Request::segment(1) == 'leavetype' ||
                                        Request::segment(1) == 'document' ||
                                        Request::segment(1) == 'performanceType' ||
                                        Request::segment(1) == 'branch' ||
                                        Request::segment(1) == 'department' ||
                                        Request::segment(1) == 'designation' ||
                                        Request::segment(1) == 'job-stage' ||
                                        Request::segment(1) == 'performanceType' ||
                                        Request::segment(1) == 'job-category' ||
                                        Request::segment(1) == 'terminationtype' ||
                                        Request::segment(1) == 'awardtype' ||
                                        Request::segment(1) == 'trainingtype' ||
                                        Request::segment(1) == 'goaltype' ||
                                        Request::segment(1) == 'paysliptype' ||
                                        Request::segment(1) == 'allowanceoption' ||
                                        Request::segment(1) == 'loanoption' ||
                                        Request::segment(1) == 'deductionoption'
                                            ? 'active dash-trigger'
                                            : ''); ?>">
                                        <a class="dash-link"
                                            href="<?php echo e(route('branch.index')); ?>"><?php echo e(__('HRM System Setup')); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(Gate::check('manage employee schedule') ||
                                        Gate::check('manage change schedule') ||
                                        Gate::check('manage overtime request') ||
                                        Gate::check('manage shifting')): ?>
                                    <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'work-schedule' || Request::segment(1) == 'change-schedule' || Request::segment(1) == 'overtime-request' ? 'active dash-trigger' : ''); ?>"
                                        href="#navbar-training" data-toggle="collapse" role="button"
                                        aria-expanded="<?php echo e(Request::segment(1) == 'employee-schedule' || Request::segment(1) == 'change-schedule' || Request::segment(1) == 'overtime-request' ? 'true' : 'false'); ?>">
                                        <a class="dash-link" href="#"><?php echo e(__('Work Schedule')); ?><span
                                                class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage shifting')): ?>
                                                <li class="dash-item <?php echo e(request()->is('shifting*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('shifting.index')); ?>"><?php echo e(__('Shifting')); ?></a>
                                                </li>                                                
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage employee schedule')): ?>
                                                <li
                                                    class="dash-item <?php echo e(request()->is('employee-schedule*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                    href="<?php echo e(route('employee-schedule.index')); ?>"><?php echo e(__('Employee Schedule')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage change schedule')): ?>
                                                <li
                                                    class="dash-item <?php echo e(request()->is('change-schedule*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('change-schedule.index')); ?>"><?php echo e(__('Change Schedule')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage overtime request')): ?>
                                                <li
                                                    class="dash-item <?php echo e(request()->is('overtime-request*') ? 'active' : ''); ?>">
                                                    <a class="dash-link"
                                                        href="<?php echo e(route('overtime-request.index')); ?>"><?php echo e(__('Overtime Request')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage reimbursement')): ?>
                                    <li class="dash-item <?php echo e(request()->is('reimbursement*') ? 'active' : ''); ?>">
                                        <a class="dash-link"
                                            href="<?php echo e(route('reimbursement.index')); ?>"><?php echo e(__('Reimburst')); ?></a>
                                    </li>
                                <?php endif; ?>


                        </ul>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <!--------------------- End HRM ----------------------------------->

            <!--------------------- Start Account ----------------------------------->

            

            <!--------------------- End Account ----------------------------------->

            <!--------------------- Start CRM ----------------------------------->

            

        <!--------------------- End CRM ----------------------------------->

        <!--------------------- Start Project ----------------------------------->

        

        <!--------------------- End Project ----------------------------------->



        <!--------------------- Start User Managaement System ----------------------------------->

        <?php if(
            \Auth::user()->type != 'super admin' &&
                (Gate::check('manage user') || Gate::check('manage role') || Gate::check('manage client'))): ?>
            <li
                class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'users' ||
                Request::segment(1) == 'roles' ||
                Request::segment(1) == 'clients' ||
                Request::segment(1) == 'userlogs'
                    ? ' active dash-trigger'
                    : ''); ?>">

                <a href="#!" class="dash-link "><span class="dash-micon"><i
                            class="ti ti-users"></i></span><span
                        class="dash-mtext"><?php echo e(__('User Management')); ?></span><span class="dash-arrow"><i
                            data-feather="chevron-right"></i></span></a>
                <ul class="dash-submenu">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage user')): ?>
                        <li
                            class="dash-item <?php echo e(Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit' || Request::route()->getName() == 'user.userlog' ? ' active' : ''); ?>">
                            <a class="dash-link" href="<?php echo e(route('users.index')); ?>"><?php echo e(__('User')); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage role')): ?>
                        <li
                            class="dash-item <?php echo e(Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'roles.create' || Request::route()->getName() == 'roles.edit' ? ' active' : ''); ?> ">
                            <a class="dash-link" href="<?php echo e(route('roles.index')); ?>"><?php echo e(__('Role')); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage client')): ?>
                        <li
                            class="dash-item <?php echo e(Request::route()->getName() == 'clients.index' || Request::segment(1) == 'clients' || Request::route()->getName() == 'clients.edit' ? ' active' : ''); ?>">
                            <a class="dash-link" href="<?php echo e(route('clients.index')); ?>"><?php echo e(__('Client')); ?></a>
                        </li>
                    <?php endif; ?>
                    
                    
                    
                    
                    
                </ul>
            </li>
        <?php endif; ?>

        <!--------------------- End User Managaement System----------------------------------->


        <!--------------------- Start Products System ----------------------------------->

        

        <!--------------------- End Products System ----------------------------------->


        <!--------------------- Start POs System ----------------------------------->
        
        <!--------------------- End POs System ----------------------------------->

        <?php if(\Auth::user()->type != 'super admin'): ?>
            <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'support' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('support.index')); ?>" class="dash-link">
                    <span class="dash-micon"><i class="ti ti-headphones"></i></span><span
                        class="dash-mtext"><?php echo e(__('Support System')); ?></span>
                </a>
            </li>
            <li
                class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'zoom-meeting' || Request::segment(1) == 'zoom-meeting-calender' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('zoom-meeting.index')); ?>" class="dash-link">
                    <span class="dash-micon"><i class="ti ti-user-check"></i></span><span
                        class="dash-mtext"><?php echo e(__('Zoom Meeting')); ?></span>
                </a>
            </li>
            <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'chats' ? 'active' : ''); ?>">
                <a href="<?php echo e(url('chats')); ?>" class="dash-link">
                    <span class="dash-micon"><i class="ti ti-message-circle"></i></span><span
                        class="dash-mtext"><?php echo e(__('Messenger')); ?></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if(\Auth::user()->type == 'company'): ?>
            <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'notification_templates' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('notification-templates.index')); ?>" class="dash-link">
                    <span class="dash-micon"><i class="ti ti-notification"></i></span><span
                        class="dash-mtext"><?php echo e(__('Notification Template')); ?></span>
                </a>
            </li>
        <?php endif; ?>

        <!--------------------- Start System Setup ----------------------------------->

        <?php if(\Auth::user()->type != 'super admin'): ?>
            <?php if(Gate::check('manage company plan') || Gate::check('manage order') || Gate::check('manage company settings')): ?>
                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'settings' ||
                    Request::segment(1) == 'plans' ||
                    Request::segment(1) == 'stripe' ||
                    Request::segment(1) == 'order'
                        ? ' active dash-trigger'
                        : ''); ?>">
                    <a href="#!" class="dash-link">
                        <span class="dash-micon"><i class="ti ti-settings"></i></span><span
                            class="dash-mtext"><?php echo e(__('Settings')); ?></span>
                        <span class="dash-arrow">
                            <i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="dash-submenu">
                        <?php if(Gate::check('manage company settings')): ?>
                            <li
                                class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'settings' ? ' active' : ''); ?>">
                                <a href="<?php echo e(route('settings')); ?>"
                                    class="dash-link"><?php echo e(__('System Settings')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(Gate::check('manage company plan')): ?>
                            <li
                                class="dash-item<?php echo e(Request::route()->getName() == 'plans.index' || Request::route()->getName() == 'stripe' ? ' active' : ''); ?>">
                                <a href="<?php echo e(route('plans.index')); ?>"
                                    class="dash-link"><?php echo e(__('Setup Subscription Plan')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(Gate::check('manage order') && Auth::user()->type == 'company'): ?>
                            <li class="dash-item <?php echo e(Request::segment(1) == 'order' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('order.index')); ?>" class="dash-link"><?php echo e(__('Order')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
        <?php endif; ?>




        <!--------------------- End System Setup ----------------------------------->
        </ul>
        <?php endif; ?>
        <?php if(\Auth::user()->type == 'client'): ?>
            <ul class="dash-navbar">
                <?php if(Gate::check('manage client dashboard')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'dashboard' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('client.dashboard.view')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-home"></i></span><span
                                class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage deal')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'deals' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('deals.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-rocket"></i></span><span
                                class="dash-mtext"><?php echo e(__('Deals')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage contract')): ?>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::route()->getName() == 'contract.index' || Request::route()->getName() == 'contract.show' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('contract.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-rocket"></i></span><span
                                class="dash-mtext"><?php echo e(__('Contract')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage project')): ?>
                    <li class="dash-item dash-hasmenu  <?php echo e(Request::segment(1) == 'projects' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('projects.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-share"></i></span><span
                                class="dash-mtext"><?php echo e(__('Project')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage project')): ?>
                    <li
                        class="dash-item  <?php echo e(Request::route()->getName() == 'project_report.index' || Request::route()->getName() == 'project_report.show' ? 'active' : ''); ?>">
                        <a class="dash-link" href="<?php echo e(route('project_report.index')); ?>">
                            <span class="dash-micon"><i class="ti ti-chart-line"></i></span><span
                                class="dash-mtext"><?php echo e(__('Project Report')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('manage project task')): ?>
                    <li class="dash-item dash-hasmenu  <?php echo e(Request::segment(1) == 'taskboard' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('taskBoard.view', 'list')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-list-check"></i></span><span
                                class="dash-mtext"><?php echo e(__('Tasks')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('manage bug report')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'bugs-report' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('bugs.view', 'list')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-bug"></i></span><span
                                class="dash-mtext"><?php echo e(__('Bugs')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('manage timesheet')): ?>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'timesheet-list' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('timesheet.list')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-clock"></i></span><span
                                class="dash-mtext"><?php echo e(__('Timesheet')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('manage project task')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'calendar' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('task.calendar', ['all'])); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-calendar"></i></span><span
                                class="dash-mtext"><?php echo e(__('Task Calender')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="dash-item dash-hasmenu">
                    <a href="<?php echo e(route('support.index')); ?>"
                        class="dash-link <?php echo e(Request::segment(1) == 'support' ? 'active' : ''); ?>">
                        <span class="dash-micon"><i class="ti ti-headphones"></i></span><span
                            class="dash-mtext"><?php echo e(__('Support')); ?></span>
                    </a>
                </li>
            </ul>
        <?php endif; ?>
        <?php if(\Auth::user()->type == 'super admin'): ?>
            <ul class="dash-navbar">
                <?php if(Gate::check('manage super admin dashboard')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'dashboard' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('client.dashboard.view')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-home"></i></span><span
                                class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage user')): ?>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('users.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-users"></i></span><span
                                class="dash-mtext"><?php echo e(__('User')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('manage plan')): ?>
                    <li class="dash-item dash-hasmenu  <?php echo e(Request::segment(1) == 'plans' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('plans.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-trophy"></i></span><span
                                class="dash-mtext"><?php echo e(__('Plan')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(\Auth::user()->type == 'super admin'): ?>
                    <li class="dash-item dash-hasmenu <?php echo e(request()->is('plan_request*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('plan_request.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-arrow-up-right-circle"></i></span><span
                                class="dash-mtext"><?php echo e(__('Plan Request')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage coupon')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'coupons' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('coupons.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-gift"></i></span><span
                                class="dash-mtext"><?php echo e(__('Coupon')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage order')): ?>
                    <li class="dash-item dash-hasmenu  <?php echo e(Request::segment(1) == 'orders' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('order.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-shopping-cart-plus"></i></span><span
                                class="dash-mtext"><?php echo e(__('Order')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'email_template' || Request::route()->getName() == 'manage.email.language' ? ' active dash-trigger' : 'collapsed'); ?>">
                    <a href="<?php echo e(route('manage.email.language', [$emailTemplate->id, \Auth::user()->lang])); ?>"
                        class="dash-link">
                        <span class="dash-micon"><i class="ti ti-template"></i></span>
                        <span class="dash-mtext"><?php echo e(__('Email Template')); ?></span>
                    </a>
                </li>

                <?php if(\Auth::user()->type == 'super admin'): ?>
                    <?php echo $__env->make('landingpage::menu.landingpage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>

                <?php if(Gate::check('manage system settings')): ?>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::route()->getName() == 'systems.index' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('systems.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-settings"></i></span><span
                                class="dash-mtext"><?php echo e(__('Settings')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        <?php endif; ?>


        
    </div>
</div>
</nav>
<?php /**PATH D:\XAMPP\htdocs\hris-ekanuri\resources\views/partials/admin/menu.blade.php ENDPATH**/ ?>