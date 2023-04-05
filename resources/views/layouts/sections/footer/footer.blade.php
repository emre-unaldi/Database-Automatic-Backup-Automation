<!-- Footer-->
<footer class="content-footer footer bg-footer-theme">
  <div class="{{ (!empty($containerNav) ? $containerNav : 'container-fluid') }} d-flex flex-wrap justify-content-center py-2 flex-md-row flex-column">
    <div class="mb-2 mb-md-0">
      Made with by <a href="{{ (!empty(config('variables.creatorUrl')) ? config('variables.creatorUrl') : '') }}" target="_blank" class="footer-link fw-bolder">{{ (!empty(config('variables.creatorName')) ? config('variables.creatorName') : '') }}</a>
      © <script>
        document.write(new Date().getFullYear())
      </script>
    </div>
  </div>
</footer>
<!--/ Footer-->
