    <!-- /.sp_wrap --></div>
<!-- /#contents --></div>

<?php include( 'cache/ranking_foot.txt' ); ?>

<?php if (is_mobile()):
    include( 'cache/sp_tab2.txt'  );
else:
    include( 'cache/pc_tab2.txt' );
endif; ?>

<?php include( 'cache/footer.txt' ); ?>

<?php wp_footer(); ?>
</body>
</html>