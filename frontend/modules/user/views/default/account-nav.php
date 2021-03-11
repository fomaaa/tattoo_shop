<nav class="nav nav--page">
	<ul class="menu">
		<li class="menu__item <?php if (Yii::$app->request->url == '/user/default') echo 'is-active' ?>">
			<a href="/user/default">изменить регистрационные данные</a>
		</li>
		<li class="menu__item <?php if (Yii::$app->request->url == '/user/default/change-password') echo 'is-active' ?>">
			<a href="/user/default/change-password">изменить пароль</a>
		</li>
	</ul>
	<ul class="menu">
		<li class="menu__item <?php if (Yii::$app->request->url == '/user/default/history') echo 'is-active' ?>">
			<a href="/user/default/history">история заказов</a>
		</li>
	</ul>
</nav>
