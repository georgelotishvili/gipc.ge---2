/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

INSERT INTO `chapters` (`id`, `course_id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'თავი 3', 'გამოყენება და დაკავებულობის კლასიფიცირება', NULL, '2025-04-26 16:52:04', '2025-05-02 10:10:09'),
(2, 1, 'თავი 1', '41 დადგენილების დასაწყისი. დოკუმენტის ზოგადი მიმოხილვა და მოქმედების სპექტრი', NULL, '2025-05-01 21:27:58', '2025-05-02 10:09:44'),
(3, 1, 'თავი 5', 'შენობის ზოგადი სიმაღლე და ფართობი', NULL, '2025-05-02 20:55:47', '2025-05-02 20:55:47'),
(4, 1, 'თავი 10', 'გასასვლელი საშუალებები: კიბეების კარებების და დერეფნების დაგეგმარება და სტრუქტურა', NULL, '2025-05-03 10:05:09', '2025-05-03 10:05:09');
INSERT INTO `courses` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, '41 დადგენილება', 'საქართველოს მთავრობის დადგენილება № 41. 2016 წლის 28 იანვარი.\r\nქ. თბილისი. ტექნიკური რეგლამენტის „შენობა–ნაგებობის უსაფრთხოების წესების“ დამტკიცების თაობაზე.', NULL, '2025-04-26 16:49:54', '2025-04-26 16:49:54');
INSERT INTO `videos` (`id`, `chapter_id`, `course_id`, `name`, `image`, `description`, `duration`, `views`, `video_id`, `library_id`, `pull_zone_id`, `video_url`, `thumbnail_url`, `created_at`, `updated_at`) VALUES
(7, 1, 1, '1. დაკავებულობის ზოგადი მიმოხილვა', NULL, 'თავი 3 - ის ძირითადი შინაარსი და დაკავებულობის ჯგუფში კლასიფიცირების წესები.', 776, 0, 'e48bafd2-e081-4784-85fe-6740483b4b7b', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/e48bafd2-e081-4784-85fe-6740483b4b7b', NULL, '2025-04-27 11:54:39', '2025-05-02 10:13:27'),
(8, 1, 1, '2. თავშეყრის ჯგუფი', NULL, 'თავშეყრის ჯგუფი - რესტორანი, კაფე, სპორტული დარბაზი, სტადიონი, სალექციო დარბაზი, თეატრები, კინოთეატრები და სხვა დაკავებულობების აღწერა', 776, 0, '7424bb51-8e56-46f4-ad35-f3a72a47e4cf', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/7424bb51-8e56-46f4-ad35-f3a72a47e4cf', NULL, '2025-04-27 11:56:03', '2025-05-02 10:17:21'),
(9, 1, 1, '3. საქმიანი ჯგუფი', NULL, 'საოფისე სივრცეები, ამბულატორიული კლინიკები და სხვა საქმიანი სივრცეების აღწერა.', 776, 0, '925ad24f-2df1-41ce-b39e-3a7dab699da7', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/925ad24f-2df1-41ce-b39e-3a7dab699da7', NULL, '2025-04-27 11:57:00', '2025-05-02 10:18:53'),
(11, 1, 1, '4. საგანმანათლებლო ჯგუფი', NULL, 'სკოლებისა და საბავშვო ბაღების დაკავებულობის ჯგუფი.', 776, 0, 'cd061251-e0f0-4402-9bfe-43c73e53b5d4', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/cd061251-e0f0-4402-9bfe-43c73e53b5d4', NULL, '2025-04-30 20:53:02', '2025-05-02 10:20:16'),
(12, 1, 1, '5. სამრეწველო ჯგუფი', NULL, 'ინდუსტრიული შენობები, ფაბრიკების და ქარხნების დაკავებულობები', 776, 0, 'df548b61-ff8d-41ec-b105-e30dfe2dacc9', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/df548b61-ff8d-41ec-b105-e30dfe2dacc9', NULL, '2025-04-30 21:25:00', '2025-05-02 10:21:32'),
(13, 1, 1, '6. დიდი საფრთხის შემცველი ჯგუფი', NULL, 'ფეთქებადი, აალებადი, მომწამლავი, კოროზიული და სხვა დიდი საფრთხის შემცველი ნივთიერებების სამყოფი სივრცეების დაკავებულობები', 776, 0, 'c688606d-70f9-49cf-9c6d-a26a4eacd3e3', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/c688606d-70f9-49cf-9c6d-a26a4eacd3e3', NULL, '2025-04-30 22:32:32', '2025-05-02 10:23:00'),
(14, 2, 1, 'დადგენილების დასაწყისი', NULL, '41 დადგენილების ამოქმედების დრო და მისი მოქმედების დიაპაზონი', 776, 0, '2defa9cf-fe45-4d76-a6a7-d9267e06554b', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/2defa9cf-fe45-4d76-a6a7-d9267e06554b', NULL, '2025-05-01 21:29:38', '2025-05-02 10:32:35'),
(15, 2, 1, 'სარჩევის განხილვა', NULL, 'დოკუმენტის წყობა და ზოგადი შინაარსის განხილვა', 776, 0, '5310c176-44aa-491d-85b0-fa447566f59d', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/5310c176-44aa-491d-85b0-fa447566f59d', NULL, '2025-05-01 21:30:45', '2025-05-02 10:33:19'),
(16, 1, 1, '7. დაწესებულებითი ჯგუფი', NULL, 'სანატორიუმების, სტაციონალური საავადმყოფოების, ციხეების და საპატიმროების დაკავებულობები.', 776, 0, '78bf4bec-fbd8-4a90-88eb-ed72ba3f9c67', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/78bf4bec-fbd8-4a90-88eb-ed72ba3f9c67', NULL, '2025-05-01 21:36:07', '2025-05-02 10:24:24'),
(17, 1, 1, '8. სავაჭრო ჯგუფი', NULL, 'მაღაზიების, აფთიაქების და სხვა სავაჭრო სივრცეების დაკავებულობები', 776, 0, '9eaea39c-6e04-4929-81f1-6a9fea57abc0', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/9eaea39c-6e04-4929-81f1-6a9fea57abc0', NULL, '2025-05-01 21:37:40', '2025-05-02 10:28:28'),
(18, 1, 1, '9. საცხოვრებელი ჯგუფი', NULL, 'მრავალბინიანი სახლების, სასტუმროების და სხვა საცხოვრებელი სივრცეების დაკავებულობები', 776, 0, '1fad351a-ebe5-4c06-9434-95f5eb49bf36', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/1fad351a-ebe5-4c06-9434-95f5eb49bf36', NULL, '2025-05-01 21:38:42', '2025-05-02 10:26:52'),
(19, 1, 1, '10. სასაწყობო ჯგუფი', NULL, 'სასაწყობო შენობებისა და ფართობების დაკავებულობები', 776, 0, 'b7308c8c-3c31-46b3-9534-47ab1be43b4e', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/b7308c8c-3c31-46b3-9534-47ab1be43b4e', NULL, '2025-05-01 21:40:07', '2025-05-02 10:27:53'),
(20, 1, 1, '11. დამხმარე ჯგუფი', NULL, 'დამხმარე სათავსები, სასოფლო სამეურნეო შენობები და ავზები.', 776, 0, '81cddaf2-fcca-40c6-bf8b-67c25072792e', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/81cddaf2-fcca-40c6-bf8b-67c25072792e', NULL, '2025-05-01 21:41:04', '2025-05-02 10:29:24'),
(21, 3, 1, '12. შენობისთვის მიწის დონის დადგენა', NULL, NULL, 776, 0, 'd689da6e-9aff-435e-8c77-19223dd4b75d', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/d689da6e-9aff-435e-8c77-19223dd4b75d', NULL, '2025-05-02 20:58:12', '2025-05-02 20:58:13'),
(22, 3, 1, '13. მიწის დონის ზედა და ქვედა სართულები', NULL, NULL, 776, 0, '2d476deb-210e-43c8-975b-cbf17c52b314', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/2d476deb-210e-43c8-975b-cbf17c52b314', NULL, '2025-05-02 20:59:29', '2025-05-02 20:59:30'),
(23, 3, 1, '14. შენობის სიმაღლე', NULL, NULL, 776, 0, '09b90d78-4422-4e3f-ad91-f39a7086bf67', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/09b90d78-4422-4e3f-ad91-f39a7086bf67', NULL, '2025-05-02 21:00:11', '2025-05-02 21:00:14'),
(24, 3, 1, 'იატაკის და შენობის მთლიანი და სუფთა ფართობები', NULL, NULL, 776, 0, '3ddc4235-07c8-4ee7-9ced-af8c103c850b', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/3ddc4235-07c8-4ee7-9ced-af8c103c850b', NULL, '2025-05-03 04:44:43', '2025-05-03 04:44:44'),
(25, 4, 1, '16. დაკავებულობის დატვირთვა', NULL, NULL, 776, 0, '489c933a-54a8-42f5-9bdc-99e948f37755', '382670', NULL, 'https://video.bunnycdn.com/library/382670/videos/489c933a-54a8-42f5-9bdc-99e948f37755', NULL, '2025-05-03 10:06:41', '2025-05-03 10:06:42');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;