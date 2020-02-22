
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      404 Error Page
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Examples</a></li>
      <li class="active">404 error</li>
    </ol>
  </section>

  <section class="content">
    <div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>

    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
        <p>
        We could not find the page you were looking for.
        Meanwhile, you may
          <?= $this->Html->link('return to dashboard', [
              'controller' => 'EmployeeInformation',
              'action' => 'home'
            ],
            ['escape' => false]
          ); ?>
        or try using the search form.
        </p>
      </div>
    </div>
  </section>
</div>
