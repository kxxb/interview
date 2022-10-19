--В базе данных имеется таблица с товарами goods (id INTEGER, name TEXT),
-- таблица с тегами tags (id INTEGER, name TEXT)
-- и таблица связи товаров и тегов goods_tags (tag_id INTEGER, goods_id INTEGER, UNIQUE(tag_id, goods_id)).
-- Выведите id и названия всех товаров, которые имеют все возможные теги в этой базе.

--РЕШЕНИЕ
-- Для вариативности предлагая как миниму два варианта.
-- Второй более оптимален, его стоимость практически в два раза меньше


--1
-- Subquery Scan on z  (cost=119.96..148.32 rows=11 width=36)
select z.good_id, z.name
from (select good_id, g.name, count(tag_id) as c
      from goods_tags
               left join goods g on g.id = goods_tags.good_id
      group by good_id, g.name) z
where z.c = (select count(*) from tags)

--2
-- Nested Loop Left Join  (cost=69.94..80.48 rows=1 width=36)
select g.id, g.name
from (select good_id, count(tag_id) as c
      from goods_tags
      group by good_id) z left join goods g on z.good_id = g.id
where z.c = (select count(*) from tags)


--Выбрать без join-ов и подзапросов
-- все департаменты,
-- в которых есть мужчины, и все они (каждый)
-- поставили высокую оценку (строго выше 5).


/**
  ПОКА НЕТ РЕШЕНИЯ

  только 2 и 3 отделы
 */
with evaluations (respondent_id, department_id, gender, value) as (
  values
    (1, 1,  true, 4),
    (2, 1, true, 6),
    (3, 1, false, 6),
    (4, 2, true, 7),
    (5, 2, true, 8),
    (6, 3, true, 7),
    (7, 3, true, 8),
    (7, 4, false, 8)
)
select  department_id   from evaluations
where gender = true

