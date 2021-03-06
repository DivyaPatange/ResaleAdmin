<!-- Sidebar navigation-->
<nav class="sidebar-nav">
    <ul id="sidebarnav" class="p-t-30">
        <?php 
            $roleAccess = Auth::guard('admin')->user()->role_access;
            $explodeRole = explode(",", $roleAccess);
        ?>
        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/admin') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
        @if(in_array("Users", $explodeRole))
        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.users.index') }}" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Users </span></a></li>
        @endif
        <li class="sidebar-item"> 
            <a class="sidebar-link waves-effect waves-dark" href="{{ route('admin.post-ad-users') }}" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Post Ad User </span></a>
        </li>
        @if(in_array("Category", $explodeRole))
        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.category.index') }}" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Categories</span></a></li>
        @endif
        @if(in_array("Sub-Category", $explodeRole))
        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.sub-category.index') }}" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Sub-Category</span></a></li>
        @endif
        @if(in_array("Suggestion", $explodeRole))
        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.suggestion.index') }}" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">Suggestion</span></a></li>
        @endif
        <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="grid.html" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Full Width</span></a></li> -->
        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Master Web</span></a>
            <ul aria-expanded="false" class="collapse  first-level">
                <!-- <li class="sidebar-item"><a href="{{ route('admin.model-name.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Model Name </span></a></li>
                <li class="sidebar-item"><a href="{{ route('admin.car-varient.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Car Varient </span></a></li>
                <li class="sidebar-item"><a href="{{ route('admin.types.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Type </span></a></li>
                <li class="sidebar-item"><a href="{{ route('admin.type-brand.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Type Brand </span></a></li> -->
                @if(in_array("State", $explodeRole))
                <li class="sidebar-item"><a href="{{ route('admin.states.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> State </span></a></li>
                @endif
                @if(in_array("City", $explodeRole))
                <li class="sidebar-item"><a href="{{ route('admin.city.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> City </span></a></li>
                @endif
                @if(in_array("Locality", $explodeRole))
                <li class="sidebar-item"><a href="{{ route('admin.locality.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Locality </span></a></li>
                @endif
                <li class="sidebar-item"><a href="{{ route('admin.rate-card.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Rate Card </span></a></li>
            </ul>
        </li>
        <?php
            $categories = DB::table('categories')->where('status', 1)->get();
        ?>
        @foreach($categories as $c)
        @if(in_array($c->category_name, $explodeRole))
        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">{{ $c->category_name }} </span></a>
            <?php
                $subCategories = DB::table('sub_categories')->where('category_id', $c->id)->where('status', 1)->get();
            ?>
            <ul aria-expanded="false" class="collapse  first-level">
                @foreach($subCategories as $s)
                <li class="sidebar-item"><a href="{{ url('admin/sub-category/' .$c->id. '/'.$s->id) }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> {{ $s->sub_category }} </span></a></li>
                @endforeach
                <!-- <li class="sidebar-item"><a href="{{ route('admin.model-name.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Model Name </span></a></li>
                <li class="sidebar-item"><a href="{{ route('admin.car-varient.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Car Varient </span></a></li>
                <li class="sidebar-item"><a href="{{ route('admin.types.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Type </span></a></li>
                <li class="sidebar-item"><a href="{{ route('admin.type-brand.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Type Brand </span></a></li>
                <li class="sidebar-item"><a href="{{ route('admin.states.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> State </span></a></li>
                <li class="sidebar-item"><a href="{{ route('admin.city.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> City </span></a></li>
                <li class="sidebar-item"><a href="{{ route('admin.locality.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Locality </span></a></li> -->
            </ul>
        </li>
        @endif
        @endforeach
        <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.category.createField') }}" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Add Form Field</span></a></li> -->
        <!-- <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">Icons </span></a>
            <ul aria-expanded="false" class="collapse  first-level">
                <li class="sidebar-item"><a href="icon-material.html" class="sidebar-link"><i class="mdi mdi-emoticon"></i><span class="hide-menu"> Material Icons </span></a></li>
                <li class="sidebar-item"><a href="icon-fontawesome.html" class="sidebar-link"><i class="mdi mdi-emoticon-cool"></i><span class="hide-menu"> Font Awesome Icons </span></a></li>
            </ul>
        </li> -->
        <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-elements.html" aria-expanded="false"><i class="mdi mdi-pencil"></i><span class="hide-menu">Elements</span></a></li> -->
        <!-- <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Addons </span></a>
            <ul aria-expanded="false" class="collapse  first-level">
                <li class="sidebar-item"><a href="index2.html" class="sidebar-link"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu"> Dashboard-2 </span></a></li>
                <li class="sidebar-item"><a href="pages-gallery.html" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> Gallery </span></a></li>
                <li class="sidebar-item"><a href="pages-calendar.html" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu"> Calendar </span></a></li>
                <li class="sidebar-item"><a href="pages-invoice.html" class="sidebar-link"><i class="mdi mdi-bulletin-board"></i><span class="hide-menu"> Invoice </span></a></li>
                <li class="sidebar-item"><a href="pages-chat.html" class="sidebar-link"><i class="mdi mdi-message-outline"></i><span class="hide-menu"> Chat Option </span></a></li>
            </ul>
        </li> -->
        <!-- <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Authentication </span></a>
            <ul aria-expanded="false" class="collapse  first-level">
                <li class="sidebar-item"><a href="authentication-login.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Login </span></a></li>
                <li class="sidebar-item"><a href="authentication-register.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Register </span></a></li>
            </ul>
        </li>
        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Errors </span></a>
            <ul aria-expanded="false" class="collapse  first-level">
                <li class="sidebar-item"><a href="error-403.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 403 </span></a></li>
                <li class="sidebar-item"><a href="error-404.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 404 </span></a></li>
                <li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 405 </span></a></li>
                <li class="sidebar-item"><a href="error-500.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 500 </span></a></li>
            </ul>
        </li> -->
    </ul>
</nav>
<!-- End Sidebar navigation -->