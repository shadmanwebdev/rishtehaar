


<script defer>
    // Add padding if admin menu open
    var body = document.querySelector('body');
    if ($('.admin_bar').length > 0) {
        var w = window.innerWidth;
        if(w > 414) {
            body.style.paddingTop = "90px";
        } else {
            body.style.paddingTop = "90px";
        }
    }

    // var scriptName = window.location.pathname.split('/').pop().replace(/\.[^/.]+$/, "");
    // console.log(scriptName);
    // if(scriptName == 'users') {
    //     var itemGroup= document.getElementById('item-group-users');
    // } else if (scriptName == 'settings') {
    //     var itemGroup= document.getElementById('item-group-settings');
    // } else if (scriptName == 'blog') {
    //     var itemGroup= document.getElementById('item-group-blog');
    // }
    // itemGroup.style.color = '#000';
    // itemGroup.style.border = '1px solid #FFB600';
    // itemGroup.style.backgroundColor = '#FFB600';

</script>

</body>
</html>