<?php

/** Language helpers shared by templates and frontend controls. */
function ntronica_current_language()
{
	$language = apply_filters('wpml_current_language', null);
	if (! is_string($language) || '' === $language) {
		$language = substr(get_locale(), 0, 2);
	}
	return 'ru' === $language ? 'ru' : 'en';
}

add_filter('body_class', function ($classes) {
	$classes[] = 'lang-' . ntronica_current_language();
	return $classes;
});

function ntronica_ui_text($english)
{
	if ('ru' !== ntronica_current_language()) {
		return $english;
	}
	static $translations = array(
		'Move up' => 'Переместить вверх',
		'Move down' => 'Переместить вниз',
		'Move left' => 'Переместить влево',
		'Move right' => 'Переместить вправо',
		'Zoom in' => 'Увеличить',
		'Zoom out' => 'Уменьшить',
		'Rotate counterclockwise' => 'Повернуть против часовой стрелки',
		'Rotate clockwise' => 'Повернуть по часовой стрелке',
		'Flip horizontally' => 'Отразить по горизонтали',
		'Flip vertically' => 'Отразить по вертикали',
		'Fit horizontally' => 'Вписать по ширине',
		'Fit vertically' => 'Вписать по высоте',
		'Reset' => 'Сбросить',
		'Toggle fullscreen' => 'Полноэкранный режим',
		'Go to slide #%d' => 'Перейти к слайду №%d',
		'It may require more than one hundred tools to produce a single modern chip. Our goal is to cover at least half of those tools — whether you are performing research & development or running mass production. We are currently present across multiple stages of chip production, such as etching and deposition, epitaxy, thermal operations, and Chemical Mechanical Planarization (CMP).' => 'Для производства одной современной микросхемы может потребоваться более сотни установок. Наша цель — обеспечить оборудование как минимум для половины этих операций, от исследований и разработок до массового производства. Мы работаем на нескольких этапах производства микросхем: травление, осаждение, эпитаксия, термическая обработка и химико-механическая планаризация (ХМП).',
		'It may require more than one hundred tools to produce a single modern chip. Our goal is to cover at least half of those tools — whether you are performing research & development or running mass production.' => 'Для производства одной современной микросхемы может потребоваться более сотни установок. Наша цель — обеспечить оборудование как минимум для половины этих операций, от исследований и разработок до массового производства.',
		'Previous media publications' => 'Предыдущие публикации в СМИ',
		'Next media publications' => 'Следующие публикации в СМИ',
		'Previous view' => 'Предыдущее изображение',
		'Next view' => 'Следующее изображение',
		'Previous: %s' => 'Предыдущие: %s',
		'Next: %s' => 'Следующие: %s',
		'Next' => 'Далее',
		'Previous' => 'Назад',
		'Error Loading Page' => 'Не удалось загрузить страницу',
		'RESULTS: ' => 'НАЙДЕНО: ',
		'Nothing found.' => 'Ничего не найдено.',
		'No products found in this category.' => 'В этой категории пока нет оборудования.',
		'Error 404' => 'Ошибка 404',
		'Sorry, we can’t find the page you are looking for. It may have been moved, deleted or the address may be incorrect' => 'Не удалось найти страницу. Возможно, она была перемещена или удалена, либо в адресе допущена ошибка.',
		'BACK TO HOMEPAGE' => 'НА ГЛАВНУЮ',
		'Front Page' => 'Главная',
		'Hero' => 'Начало страницы',
		'About' => 'О компании',
		'About us' => 'О нас',
		'Company overview' => 'О компании',
		'Our goal' => 'Наша цель',
		'Company information' => 'Информация о компании',
		'Technology' => 'Технологии',
		'Technological processes' => 'Технологические процессы',
		'All about microchips' => 'Всё о микросхемах',
		'Chip making processes' => 'Процессы производства микросхем',
		'Products' => 'Оборудование',
		'Thin films equipment' => 'Оборудование для тонкоплёночных процессов',
		'Wet process equipment' => 'Оборудование для жидкостной обработки',
		'Process control' => 'Контроль технологических процессов',
		'News' => 'Новости',
		'Events & news' => 'События и новости',
		'Press releases' => 'Пресс-релизы',
		'Media publications' => 'Публикации в СМИ',
		'Mass media publications' => 'Публикации в СМИ',
		'Careers' => 'Карьера',
		'Our team' => 'Наша команда',
		'Open positions' => 'Открытые вакансии',
		'Immediate vacancies' => 'Открытые вакансии',
		'Contacts' => 'Контакты',
		'Contact us' => 'Связаться с нами',
		'CONTACT US' => 'СВЯЗАТЬСЯ С НАМИ',
		'Our representative' => 'Наше представительство',
		'Uncategorized' => 'Без категории',
		'Machine Characteristics' => 'Характеристики оборудования',
		'Parameter' => 'Параметр',
		'Process description' => 'Описание процесса',
		'TEAM' => 'КОМАНДА',
		'WORK EXPERIENCE' => 'ОПЫТ РАБОТЫ',
		'EDUCATION BACKGROUND' => 'ОБРАЗОВАНИЕ',
		'Responsibilities' => 'Обязанности',
		'Requirements' => 'Требования',
		'LEARN MORE' => 'ПОДРОБНЕЕ',
		'SHARE THIS ARTICLE' => 'ПОДЕЛИТЬСЯ СТАТЬЁЙ',
		'Share this article' => 'Поделиться статьёй',
		'Show more' => 'Показать больше',
		'Show less' => 'Свернуть',
		'Breadcrumb' => 'Навигационная цепочка',
		'Page navigation' => 'Навигация по странице',
		'About sections' => 'Разделы страницы о компании',
		'Technology sections' => 'Разделы страницы технологий',
		'Products sections' => 'Разделы страницы оборудования',
		'Careers sections' => 'Разделы страницы карьеры',
		'Contacts sections' => 'Разделы страницы контактов',
		'Sections: %s' => 'Разделы: %s',
		'Switch to %s' => 'Переключить язык на %s',
		'Previous machine' => 'Предыдущее оборудование',
		'Next machine' => 'Следующее оборудование',
		'Previous image' => 'Предыдущее изображение',
		'Next image' => 'Следующее изображение',
		'Previous news' => 'Предыдущие новости',
		'Next news' => 'Следующие новости',
		'Previous publications' => 'Предыдущие публикации',
		'Next publications' => 'Следующие публикации',
		'Laboratory equipment' => 'Лабораторное оборудование',
		'Engineer in a cleanroom suit operating laboratory equipment' => 'Инженер в защитном костюме работает с лабораторным оборудованием',
		'Laboratory technicians working at microscopes in a sterile facility' => 'Специалисты работают с микроскопами в чистом помещении',
		'Technicians in cleanroom suits in a semiconductor facility' => 'Специалисты в защитных костюмах на производстве полупроводников',
		'Map of N-tronica representative location' => 'Карта расположения представительства Нанотроники',
		'Key features:' => 'Ключевые особенности:',
		'We develop innovative equipment to enable the full cycle of microelectronics production and complex r&d activities' => 'Мы разрабатываем инновационное оборудование для полного цикла производства микроэлектроники и комплексных научных исследований',
		'Enter your name' => 'Введите ваше имя',
		'Enter a valid e-mail' => 'Введите корректный адрес электронной почты',
		'Enter a valid phone number' => 'Введите корректный номер телефона',
		'ADD FILE' => 'ДОБАВИТЬ ФАЙЛ',
		'REPLACE FILE' => 'ЗАМЕНИТЬ ФАЙЛ',
		'Remove item' => 'Удалить файл',
		'SENDING...' => 'ОТПРАВКА...',
		'Previous slide' => 'Предыдущий слайд',
		'Next slide' => 'Следующий слайд',
		'This is the first slide' => 'Это первый слайд',
		'This is the last slide' => 'Это последний слайд',
		'Go to slide {{index}}' => 'Перейти к слайду {{index}}',
		'Close' => 'Закрыть',
		'You can close this modal content with the ESC key' => 'Чтобы закрыть окно, нажмите Escape',
		'Something Went Wrong, Please Try Again Later' => 'Произошла ошибка. Попробуйте позже.',
		'Image Not Found' => 'Изображение не найдено',
		'HTML Element Not Found' => 'Содержимое не найдено',
		'Error Loading AJAX : Not Found' => 'Запрашиваемое содержимое не найдено',
		'Error Loading AJAX : Forbidden' => 'Нет доступа к запрашиваемому содержимому',
		'Toggle zoom level' => 'Изменить масштаб',
		'Toggle slideshow' => 'Запустить или остановить слайд-шоу',
		'Toggle full-screen mode' => 'Полноэкранный режим',
		'Toggle thumbnails' => 'Показать или скрыть миниатюры',
		'Download' => 'Скачать',
		'What a chip is' => 'Что такое микросхема',
		'How chips are made' => 'Как производят микросхемы',
		'Why nanometers matter' => 'Почему важны нанометры',
		'Moore’s law today' => 'Закон Мура сегодня',
		'An integrated circuit is a network of transistors and passive elements formed in and on a single-crystal silicon. The transistor is the switch; enough of them create logic and memory. The structure is built by repeating deposition, lithography, etching, and heat treatment across the wafer. A modern die packs tens of billions of switches into a few square centimeters.' => 'Интегральная схема — это сеть транзисторов и пассивных элементов, сформированных в монокристаллическом кремнии и на его поверхности. Транзистор работает как переключатель; множество таких элементов образуют логику и память. Структуру создают, повторяя осаждение, литографию, травление и термическую обработку пластины. Современный кристалл содержит десятки миллиардов переключателей на площади в несколько квадратных сантиметров.',
		'A wafer enters the fab bare and leaves carrying hundreds of finished dies. Between those points lie epitaxy, deposition, lithography, etching, doping, annealing, planarization and cleaning — each repeated for every layer. An advanced device takes 500 to 1,000 steps to complete and the wafer travels tens of kilometers inside the fab before diced.' => 'Пластина поступает на производство без сформированных структур, а выходит с сотнями готовых кристаллов. Между этими этапами — эпитаксия, осаждение, литография, травление, легирование, отжиг, планаризация и очистка, которые повторяются для каждого слоя. Изготовление современного прибора включает от 500 до 1000 операций; до разделения на кристаллы пластина проходит десятки километров внутри фабрики.',
		'Printed features are smaller than the wavelength of visible light: a transistor gate is a few dozen atoms across, while a human hair is 100,000 nm wide. At that scale, one particle, a fraction of a degree of drift, or a nanometer of misalignment turns a working die into scrap. Metrology is part of the process, and equipment is specified by how little it drifts rather than by how fast it runs.' => 'Размеры формируемых элементов меньше длины волны видимого света: ширина затвора транзистора составляет несколько десятков атомов, тогда как толщина человеческого волоса — около 100 000 нм. В таком масштабе одна частица, отклонение температуры на долю градуса или смещение на нанометр могут сделать кристалл непригодным. Метрология становится частью процесса, а требования к оборудованию определяются прежде всего стабильностью параметров.',
		'In 1965, Gordon Moore noticed that transistor counts per chip were doubling every year, and the industry has tracked that curve ever since. Geometric shrink is slowing, so density now also comes from new architectures, materials, and stacking: 3D integration, GaN & SiC power devices, advanced packaging. Being first with a denser generation has always paid for the chipmakers.' => 'В 1965 году Гордон Мур заметил, что количество транзисторов на микросхеме ежегодно удваивается. Это наблюдение стало ориентиром для отрасли. Уменьшение геометрических размеров замедляется, поэтому плотность повышают также за счёт новых архитектур, материалов и многослойных структур: трёхмерной интеграции, силовых приборов на GaN и SiC, современных технологий корпусирования. Ранний выход на новое поколение более плотных микросхем даёт производителям преимущество.',
		'Microchips are the smallest structures humanity makes in volume — and the foundation of everything from a phone to a power grid. Here is what a chip is, how it is built layer by layer, and where our equipment fits into that flow.' => 'Микросхемы — одни из самых миниатюрных структур, которые человечество производит массово. Они лежат в основе устройств от телефона до электросети. Здесь мы рассказываем, что такое микросхема, как её создают слой за слоем и какую роль в этом играет наше оборудование.',
		'A single die holds billions of transistors, formed through hundreds of steps on a wafer under a millimetre thick. Each step is spans the wafer with nanometre accuracy and needs dedicated equipment, process control and metrology.' => 'Один кристалл содержит миллиарды транзисторов, которые формируются за сотни операций на пластине толщиной менее миллиметра. Каждый этап требует нанометровой точности по всей поверхности пластины, специализированного оборудования, контроля процесса и метрологии.',
		'Chips are classified in two ways: by what they do and by the circuitry inside them. By circuitry, a chip is analogue, digital, or mixed-signal. Digital circuits work with binary levels; analogue circuits handle continuous signals using resistors, capacitors, and inductors. By function, the main families are logic, memory, application-specific circuits (ASIC), and systems-on-chip (SoC), which combine analogue and digital blocks on one die. Power and RF devices on GaN and SiC form a class of their own — built on dedicated equipment and judged by breakdown voltage and thermal behaviour rather than by transistor count.' => 'Микросхемы классифицируют по назначению и типу схем. По типу схем они бывают аналоговыми, цифровыми и смешанными. Цифровые схемы работают с двоичными уровнями, аналоговые обрабатывают непрерывные сигналы с помощью резисторов, конденсаторов и катушек индуктивности. По назначению выделяют логические схемы, память, специализированные интегральные схемы (ASIC) и системы на кристалле (SoC), объединяющие аналоговые и цифровые блоки. Силовые и радиочастотные приборы на GaN и SiC составляют отдельный класс: для них требуется специализированное оборудование, а ключевыми характеристиками служат напряжение пробоя и тепловые свойства.',
		'Manufacturing is a cycle repeated for every layer: deposit a&nbsp;film, print the pattern, etch it, clean, planarize, then measure. An advanced device stacks up to a hundred layers, each aligned to the one beneath it within a few nanometers. Several hundred steps and about three months separate a bare wafer from packaged chips — so yield depends less on any single tool than on how tightly the whole sequence is held. That is why metrology and inspection sit between the process steps rather than after them, and why a fab is kept thousands of times cleaner than outside air.' => 'Производственный цикл повторяется для каждого слоя: осаждение плёнки, формирование рисунка, травление, очистка, планаризация и измерение. Современный прибор может содержать до сотни слоёв, совмещённых с точностью до нескольких нанометров. Между исходной пластиной и корпусированными микросхемами — сотни операций и около трёх месяцев работы. Поэтому выход годных изделий зависит от точности всей последовательности. Метрология и инспекция выполняются между технологическими этапами, а чистота воздуха на фабрике в тысячи раз выше, чем снаружи.',
		'Every day at N-tronica, we create tools that enable the production of the chips powering our world. From large-scale manufacturing to advanced R&D, our work helps accelerate innovation and bring new technologies to life faster. We take pride in contributing to devices that are faster, smarter, and more efficient.' => 'Каждый день в Нанотронике мы создаём оборудование для производства микросхем, на которых работает современный мир. От массового производства до передовых исследований — наша работа помогает ускорять разработку и внедрение новых технологий. Мы гордимся своим вкладом в создание более быстрых, интеллектуальных и эффективных устройств.',
		'We design and manufacture etching, deposition, and epitaxy tools— key elements in the semiconductor production process.' => 'Мы разрабатываем и производим установки травления, осаждения и эпитаксии — оборудование для ключевых этапов производства полупроводников.',
		'At the same time, we are growing into chemical mechanical planarization, metrology, and analytics to offer a broader and more integrated set of solutions.' => 'Одновременно мы развиваем направления химико-механической планаризации, метрологии и аналитики, чтобы предложить более широкий и комплексный набор решений.',
		'We are a team of passionate individuals dedicated to advancing the remarkable world of semiconductors. Our people bring experience from every angle — not only as developers, engineers, and constructors, but also as technologists and highly qualified equipment users.' => 'Наша команда стремится развивать технологии полупроводников. Мы объединяем опыт разработчиков, инженеров, конструкторов, технологов и специалистов по эксплуатации оборудования.',
		'Mail' => 'Почта',
		'Eml' => 'Почта',
		'Tel' => 'Тел.',
		'Web' => 'Сайт',
		'Add' => 'Адрес',
		'Search' => 'Поиск',
		'Clear' => 'Очистить',
		'Privacy policy' => 'Политика конфиденциальности',
		'Terms of use' => 'Условия использования',
		'Copyright (c) 2025-2026' => '© 2025–2026',
		'Previous process' => 'Предыдущий процесс',
		'Next process' => 'Следующий процесс',
		'This site uses cookies to improve service.' => 'Этот сайт использует файлы cookie для улучшения работы.',
		'Click to agree, personalize your experience and make your future visit even better' => 'Вы можете принять все файлы cookie или настроить свои предпочтения.',
		'Manage cookies' => 'Настроить cookie',
		'Accept all' => 'Принять все',
		'Close cookie settings' => 'Закрыть настройки cookie',
		'Manage cookie preferences' => 'Настройки файлов cookie',
		'Configure cookie settings and confirm to save your settings. You can change consent at any time on our cookie consent page' => 'Выберите категории файлов cookie и подтвердите настройки. Вы можете изменить своё согласие в любое время в настройках cookie.',
		'Functional Cookies' => 'Функциональные cookie',
		'Performance Cookies' => 'Аналитические cookie',
		'Targeting Cookies' => 'Рекламные cookie',
		'Confirm' => 'Подтвердить',
		'These cookies enable the website to provide enhanced functionality and personalization. They may be set by us or third-party providers whose services we added to our pages. If you do not allow these cookies, some or all of these services may not function properly.' => 'Эти файлы cookie обеспечивают дополнительные функции и персонализацию сайта. Их можем устанавливать мы или сторонние поставщики сервисов, добавленных на наши страницы. Если вы отключите эти файлы cookie, некоторые сервисы могут работать некорректно.',
		'These cookies collect anonymous data about how visitors use our website. They help track visits and traffic sources, allowing us to measure and improve site performance. If you disable them, we won\'t know when you visited or be able to analyze how the website performs.' => 'Эти файлы cookie собирают анонимные данные об использовании сайта. Они помогают учитывать посещения и источники трафика, оценивать и улучшать работу сайта. Если вы их отключите, мы не сможем учитывать ваше посещение при анализе работы сайта.',
		'These cookies enable the website to provide enhanced functionality and personalization. They may be set by us or by third-party providers whose services are added to our pages. If you disable these cookies, some or all of these services may not function properly.' => 'Эти файлы cookie обеспечивают дополнительные функции и персонализацию сайта. Их можем устанавливать мы или сторонние поставщики сервисов, добавленных на наши страницы. Если вы отключите эти файлы cookie, некоторые сервисы могут работать некорректно.',
		'Necessary Cookies' => 'Обязательные cookie',
		'Cookie notice' => 'Уведомление о файлах cookie',
		'These cookies are necessary for the website to function and cannot be switched off. They are set in response to your actions, like preferences or logging in. You can block or alert them in your browser, but parts of the site may not work. They do not store personal data.' => 'Эти файлы cookie необходимы для работы сайта и не отключаются в его настройках. Они устанавливаются в ответ на ваши действия, например выбор настроек или вход в систему. Вы можете заблокировать их в браузере, но тогда некоторые функции сайта могут не работать. Они не хранят персональные данные.',
	);
	return $translations[$english] ?? $english;
}

// Keep WPML translations when present; supply Russian UI copy otherwise.
add_filter('gettext_ntronica', function ($translation, $text) {
	return $translation === $text ? ntronica_ui_text($text) : $translation;
}, 10, 2);

/** Labels used by JS components, from the same catalog as the PHP templates. */
function ntronica_frontend_translations()
{
	$labels = array(
		'form' => array(
			'nameError' => 'Enter your name', 'emailError' => 'Enter a valid e-mail',
			'phoneError' => 'Enter a valid phone number', 'addFile' => 'ADD FILE',
			'replaceFile' => 'REPLACE FILE', 'removeFile' => 'Remove item', 'sending' => 'SENDING...',
		),
		'swiper' => array(
			'prevSlideMessage' => 'Previous slide', 'nextSlideMessage' => 'Next slide',
			'firstSlideMessage' => 'This is the first slide', 'lastSlideMessage' => 'This is the last slide',
			'paginationBulletMessage' => 'Go to slide {{index}}',
		),
		'fancybox' => array(
			'PANUP' => 'Move up', 'PANDOWN' => 'Move down', 'PANLEFT' => 'Move left', 'PANRIGHT' => 'Move right',
			'ZOOMIN' => 'Zoom in', 'ZOOMOUT' => 'Zoom out', 'TOGGLEZOOM' => 'Toggle zoom level',
			'TOGGLE1TO1' => 'Toggle zoom level', 'ITERATEZOOM' => 'Toggle zoom level',
			'ROTATECCW' => 'Rotate counterclockwise', 'ROTATECW' => 'Rotate clockwise',
			'FLIPX' => 'Flip horizontally', 'FLIPY' => 'Flip vertically',
			'FITX' => 'Fit horizontally', 'FITY' => 'Fit vertically', 'RESET' => 'Reset',
			'TOGGLEFS' => 'Toggle fullscreen', 'GOTO' => 'Go to slide #%d',
			'CLOSE' => 'Close', 'NEXT' => 'Next', 'PREV' => 'Previous',
			'MODAL' => 'You can close this modal content with the ESC key',
			'ERROR' => 'Something Went Wrong, Please Try Again Later', 'IMAGE_ERROR' => 'Image Not Found',
			'ELEMENT_NOT_FOUND' => 'HTML Element Not Found', 'AJAX_NOT_FOUND' => 'Error Loading AJAX : Not Found',
			'AJAX_FORBIDDEN' => 'Error Loading AJAX : Forbidden', 'IFRAME_ERROR' => 'Error Loading Page',
			'TOGGLE_ZOOM' => 'Toggle zoom level', 'TOGGLE_THUMBS' => 'Toggle thumbnails',
			'TOGGLE_SLIDESHOW' => 'Toggle slideshow', 'TOGGLE_FULLSCREEN' => 'Toggle full-screen mode',
			'DOWNLOAD' => 'Download',
		),
	);
	return array_map(static function ($group) { return array_map('ntronica_ui_text', $group); }, $labels);
}

/** Resolve the translated page rather than appending an English slug to /ru/. */
function ntronica_page_url($slug)
{
	$page = get_page_by_path($slug);
	if ($page) {
		$id = apply_filters('wpml_object_id', $page->ID, 'page', true, ntronica_current_language());
		return get_permalink($id);
	}
	return home_url('/' . trim($slug, '/') . '/');
}
