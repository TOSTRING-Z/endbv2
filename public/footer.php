<footer>
    <div class="d-flex justify-content-center p-5 mt-3 bg-secondary">
        <b class="text-gray mr-3">Copyright &copy; HMU</b>
        <a class="text-decoration-none font-weight-bold text-gray mr-3" href="http://www.beian.miit.gov.cn">黑ICP备16009434号-1</a>
        <a class="text-decoration-none font-weight-bold text-gray" href="http://www.licpathway.net/" target="_blank">Li C Lab</a>
    </div>
</footer>
<script>
    $(document).ready(() => {
        var sp1 = location.toString().split('/');
        sp1.reverse();
        var sp2 = sp1.length === 5 ? sp1[0] : (sp1[1] + ".php");
        if (sp2 === '')
            sp2 = 'index.php';
        $('a[href*="/' + sp2 + '"]').parents('li').addClass('active');

        setTimeout(function() {
            $("*[height-to]").each(function(t, e) {
                var height_to = $(e).attr("height-to");
                if (height_to) {
                    $(e).css("height", $("#" + height_to).css("height"));
                    $(e).css("overflow-y", "auto");
                    $(e).css("overflow-x", "hidden");
                }
            })
        }, 500);
    });
</script>
