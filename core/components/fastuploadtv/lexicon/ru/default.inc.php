<?php


$_lang['fastuploadtv'] = 'Простая загрузка файла';



// TV Input Properties
$_lang['fastuploadtv.save_path'] = 'Путь сохранения';
$_lang['fastuploadtv.save_path_desc'] = 'Путь для сохранения относительно корня медиа-ресурса';
$_lang['fastuploadtv.file_prefix'] = 'Префикс имени файла';
$_lang['fastuploadtv.file_prefix_desc'] = 'Дополнительный префикс имени файла для загрузки файлов. Например {y}-{m}-{d}-';
$_lang['fastuploadtv.mime_types'] = 'Принимаемые типы MIME';
$_lang['fastuploadtv.mime_types_desc'] = 'Дополнительный список разделенных запятыми типов MIME';
$_lang['fastuploadtv.show_value'] = 'Показывать значение TV';
$_lang['fastuploadtv.show_value_desc'] = 'Отображать путь к файлу';
$_lang['fastuploadtv.show_preview'] = 'Показать изображение';
$_lang['fastuploadtv.show_preview_desc'] = 'Отображать миниатюру изображений';
$_lang['fastuploadtv.prefix_filename'] = 'Использовать префикс как имя файла';

// TV Render 
$_lang['fastuploadtv.upload_file'] = 'Загрузить файл';
$_lang['fastuploadtv.replace_file'] = 'Заменить файл';
$_lang['fastuploadtv.clear_file'] = 'Удалить';

// Errors
$_lang['fastuploadtv.error_tvid_ns'] = 'Ошибка: modTemplateVar ID не обеспечивается';
$_lang['fastuploadtv.error_tvid_invalid'] = 'Ошибка: неверное условие modTemplateVar';

$_lang['fastuploadtv.err_file_ns'] = 'Ошибка: файл не был загружен';
$_lang['fastuploadtv.err_save_resource'] = 'Перед добавлением новых элементов, вам необходимо сохранить этот ресурс!';

// Settings
$_lang['setting_fastuploadtv.translit'] = 'Транслитерация файлов';
$_lang['setting_fastuploadtv.translit_desc'] = 'При включенной настройке, имена всех загружаемых файлов будут написаны транслитом. Настройка работает только при установленном дополнении "translit"';
$_lang['setting_fastuploadtv.check_resid'] = 'Загружать только при редактировании';
$_lang['setting_fastuploadtv.check_resid_desc'] = 'Пока ресурс не будет сохранен, файл не получится загрузить. Рекомендуется оставить включенным эту настройку. Иначе могут возникнуть проблемы при использовании плейсхолдеров {alias} и {palias} - у несохранных ресурсов они будут возвращать пустые значения.';
$_lang['setting_fastuploadtv.preview_width_max'] = 'Ширина миниатюры';
$_lang['setting_fastuploadtv.preview_width_max_desc'] = 'Максимальная ширина миниатюры (в админ-панели)';
$_lang['setting_fastuploadtv.preview_height_max'] = 'Высота миниатюры';
$_lang['setting_fastuploadtv.preview_height_max_desc'] = 'Максмальная высота миниатюры (в админ-панели)';
$_lang['setting_fastuploadtv.random_lenght'] = 'Длина плейсхолдера {rand}';