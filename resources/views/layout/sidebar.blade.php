<div class="col-md-2 p-0 m-0 sidebar specific-scroll">
    <header>
        <div class="container-1">
            <img src="{{ asset('assets/img/logofinal.png') }}" class="logo">
        </div>
    </header>
    <div class="tabs">

        <!-- for sub-tabs ________________________________________  -->
        <!-- hostings -->
        <a href="#" class="tabbtn" data-src="modules/hostandlic/index.php">Hosting and Licensing</a>
        <div class="sub-tabs" style="display: none; padding-left: 20px;">
            <a href="#" data-src="modules/hostandlic/hosting.php" class="w-100 sub-tabbtn">Hosting</a>
            <a href="#" data-src="modules/hostandlic/login/register.php" class=" w-100 sub-tabbtn">Logins</a>
            <a href="#" data-src="modules/spla/index.php" class="w-100 sub-tabbtn">SPLA Licensing</a>
            <a href="#" data-src="modules/device/index.php" class="w-100 sub-tabbtn">Devices</a>
        </div>

        <!-- admin service -->
        <a href="" class="tabbtn" data-src="modules/dashboard.php">Dashboard</a>
        <a href="" class="tabbtn" data-src="modules/broker/index.php">Brokers</a>
        <a href="" class="tabbtn" data-src="modules/clientinfo/index.php">Clients</a>
        <a href="" class="tabbtn" data-src="modules/reports">Reports</a>
    </div>
    <div>
        <a href="?logout=1" class="logout-btn">Logout</a>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabButtons = document.querySelectorAll('.tabbtn');

    tabButtons.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            // Check if this tab has a next sibling with class `sub-tabs`
            const next = this.nextElementSibling;
            if (next && next.classList.contains('sub-tabs')) {
                next.style.display = next.style.display === 'none' ? 'block' : 'none';
            }
        });
    });
});
</script>

