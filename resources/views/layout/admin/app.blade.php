<!DOCTYPE html>
<Html>
<Head>
    <Title>
        @yield('title')
    </Title>

    @include('layout.admin.common.head')
    @yield('head')

</Head>

<Body>

  <!--Begin Page-->
  <div class = "wrapper">
   @include('layout.admin.common.header')
   @include('layout.admin.common.sidebar')

   <!-- ============================================================== -->
   <!-- Start right Content here -->
   <!-- ============================================================== -->
   <div class="content-page">
    <!-- Start content -->
    <div class="content">

        @yield('content')

    </div> <!-- content -->

    @include('layout.admin.common.footer')

</div>

<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->

</div>
<!-- END wrapper -->

@include('layout.admin.common.js')
@yield('scripts')
</Body>
</Html>