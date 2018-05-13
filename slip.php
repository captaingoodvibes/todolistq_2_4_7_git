
<body>
<h1>Slip.js</h1>
<p>Swiping and reordering lists of elements on touch screens, no fuss. A&nbsp;tiny library by <a href="http://twitter.com/pornelski">Kornel</a>.</p>
<ol id="slippylist">
    <li class="demo-no-reorder">Swipe,</li>
    <li class="demo-no-swipe">hold &amp; reorder <span class="instant">or instantly</span></li>
    <li>or either</li>
    <li class="demo-no-swipe demo-no-reorder">or none of them.</li>
    <li>Can play nicely with:</li>
    <li>interaction <input type="range"></li>
    <li style="transform: scaleX(0.97) skewX(-10deg); -webkit-transform: scaleX(0.97) skewX(-10deg)">inline CSS transforms</li>
    <li class="skewed">stylesheet transforms</li>
    <li class="demo-allow-select"><span class="demo-no-reorder">and selectable text, even though animating elements with selected text is a bit weird.</span></li>
    <li>iOS Safari</li>
    <li>Mobile Chrome</li>
    <?PHP 
    $down_right = '&#9495;';
    $right_flat = '&#9473;';
    echo "<li>" . $down_right . $right_flat . "thanks</li>";
    ?>
    <li>Android Firefox</li>
    <li>Opera Presto and Blink</li>
    <li>No dependencies</li>
</ol>
<h2>Known limitations</h2>
<ul>
    <li>Tap &amp; hold is too sensitive in Firefox (W3C TouchEvents specification is ambiguous about sensitivity of touch movements, so strictly speaking that's a spec bug, not a browser bug.)</li>
    <li>There are few bits in animations that could be smoother or more efficient.</li>
</ul>
<p><a href="https://github.com/pornel/slip">Bug/fork/star on GitHub</a>.</p>
<script src="slip.js"></script>
<script>
    var ol = document.getElementById('slippylist');
    ol.addEventListener('slip:beforereorder', function(e){
        if (/demo-no-reorder/.test(e.target.className)) {
            e.preventDefault();
        }
    }, false);

    ol.addEventListener('slip:beforeswipe', function(e){
        if (e.target.nodeName == 'INPUT' || /demo-no-swipe/.test(e.target.className)) {
            e.preventDefault();
        }
    }, false);

    ol.addEventListener('slip:beforewait', function(e){
        if (e.target.className.indexOf('instant') > -1) e.preventDefault();
    }, false);

    ol.addEventListener('slip:afterswipe', function(e){
        e.target.parentNode.appendChild(e.target);
    }, false);

    ol.addEventListener('slip:reorder', function(e){
        e.target.parentNode.insertBefore(e.target, e.detail.insertBefore);
        return false;
    }, false);

    new Slip(ol);
</script>
