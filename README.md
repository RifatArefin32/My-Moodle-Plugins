# Curriculum

**Curriculum** is a local plugin.

### File Descriptions:
1. version.php: 
    - version file of this plugin

2. manage.php:
    - Show all the categories to the admin
    - Admin can create new course
    - Admin can add courses and show courses to the corresponding category.

3. lib.php:
    - Used for creating functions

4. edit.php:
    - Redirected from manage.php on action of "Add courses" button  
    - Displays all the courses as checkbox and then added to the category

5. category_list.php:
    - Student can see all the assigned categories here

6. course_list.php
    - Student can see all the courses of the assigned category from category_list.php
    - Complete all the courses sequentially 
    - A course is enrolled only if the prior course has been enrolled already
