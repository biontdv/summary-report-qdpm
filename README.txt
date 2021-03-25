DESCRIPTION
Immobi Tracker V.0.1 adalah program qdPM Custom antara qdPM current dan program laravel untuk mempermudah user melihat Report project summary dan project summary per PIC.


New Feature Immobi Tracker V.0.1 
A. Penambahan menu untuk project summary
   - Pie Chart 
   - Column Chart
   - Export CSV
   - List Query Open Task
B. Penambahan menu untuk project summary per PIC
   - Group Column Chart
   - Export CSV
   - List Query Open Task

List Task Immobi Tracker V.0.1
- Get Login user session qdPM untuk menghubungkan qdPM (Symfony) dengan program   reporting (laravel)(1580)
- Menambah menu custom report pada Sidebar qdPM symfony(1579)
- Pembuatan view untuk project summary (1559)
- Chart untuk Project Summary (1562)
- Pembuatan view untuk Project Summary per PIC(1561)
- Chart untuk Project Summary per PIC(1563)
- Pembuatan view untuk query Project Summary per PIC per Task Group(1560)
- CSS & Style Project Summary(1564)
- CSS & Style Project Summary per PIC(1565)
- Query Open Task Project Summary(1566)
- Query Open Task Project Summary per PIC (1567)

Perubahan qdPM Symfony
- Penambahan code di line 93 - 99 ([Nama Folder qdPM]/core/apps/qdPM/modules/login/actions/actions.class.php) untuk meredirect aplikasi menuju aplikasi laravel
- Penambahan code di line 50 ([Nama Folder qdPM]/core/lib/menuController.php) untuk fungsi logout

Perubahan Database
- Penambahan View : 
	1.pivot_summary_project
	2.pivot_summary_pic_project
	3.project_summary_status
	4.query_opentasks_picsummary
	5.query_opentasks_projectsummary
	6.summary_pic_project
	7.summary_pic_project_raw
	8.summary_project_raw
	9.summary_project_selected_task_status
