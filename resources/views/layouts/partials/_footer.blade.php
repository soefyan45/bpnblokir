<footer class="main-footer">
    <div class="footer-left tahun-footer" id="tahun-footer">
    </div>
    <div class="footer-right">
        v1.0
    </div>
</footer>
<script>
    $( document ).ready(function() {
        var d = new Date();
        var n = d.getFullYear();
        document.getElementById("tahun-footer").innerHTML = n+'  <div class="bullet"></div>BPN KAB.Kampar|Pengjakian Blokir Online';
    });
</script>
