	</div></div></div>
	<div id="footer">
		<div id="mainwrapper" style="text-align: center;">
		    <span style="line-height: 20px;">
            © 2025 Snowy Fox Fortress<br>
            “Crafted with caffeine, PHP, and blood.”
            </span>
		</div>
	</div>
</div>
<script>

{$query}

{literal}
window.addEvent('domready', function(){

	ProcessAdminTabs();

    var Tips2 = new Tips($('.tip'), {
        initialize:function(){
            this.fx = new Fx.Style(this.toolTip, 'opacity', {duration: 300, wait: false}).set(0);
        },
        onShow: function(toolTip) {
            this.fx.start(1);
        },
        onHide: function(toolTip) {
            this.fx.start(0);
        }
    });
    var Tips4 = new Tips($('.perm'), {
        className: 'perm'
    });
});
{/literal}
</script>
</body>
</html>
