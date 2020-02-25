<style type="text/css">
  .loading_modal {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background: rgba(255, 255, 255, .8)
                url('/webroot/img/loading.gif')
                50% 50%
                no-repeat;
  }
  body.loading {
    overflow: hidden;
  }
  body.loading .loading_modal {
    display: block;
  }
</style>
<div class="loading_modal"></div>