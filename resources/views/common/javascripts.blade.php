<!--   Core JS Files   -->
<script src="{{ url('assets/js/core/popper.min.js') }}"></script>
<script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ url('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ url('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ url('assets/js/plugins/chartjs.min.js') }}"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ url('assets/js/material-dashboard.min.js') }}?_v{{ time() }}"></script>

<script>
    panel._createInfoPopup();
    panel._createTosats();
    //panel.toast.call('dangerToast','Lorem','Control Center for Material Dashboard: parallax effects');
    //panel.toast.call('successToast','Lorem','Control Center for Material Dashboard: parallax effects');
    //panel.toast.call('warningToast','Lorem','Control Center for Material Dashboard: parallax effects');
    //panel.toast.call('infoToast','Lorem','Control Center for Material Dashboard: parallax effects');
    //panel.toast.call('whiteToast','Lorem','Control Center for Material Dashboard: parallax effects');
    //panel.vueTable['myTable'].loadPage(2);

</script>
