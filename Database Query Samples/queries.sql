/* Simple and complex queries */

--Query 1
select word, lyrics_count
from unified.ms_lyrics msl
join unified.ms_songs_summary msss
on msl.track_id = msss.track_id
where msss.artist_name = 'Aerosmith'
order by lyrics_count desc
limit 10;

--Query 2 
select count(packaging), packaging 
from unified.mb_release
group by packaging;

--Query 3
select title, artist_name
from unified.ms_songs_summary msss
join unified.ms_songs_popularity mssp
on msss.song_id = mssp.song
group by title, artist_name, play_count;
having mssp.play_count = max(mssp.play_count);

--Query 4
select count(play_count)
from unified.ms_songs_popularity mssp
join unified.ms_songs_summary msss
on msss.song_id	 = mssp.song
where song in (
	select song_id from unified.ms_songs_summary msss
	where msss.artist_id in (
		select msss.artist_id
		from unified.ms_artist_term msat
		join unified.ms_songs_summary msss
		on msss.artist_id = msat.artist_id
		where term = 'free jazz'));

--Query 5
select count(event)
from unified.event_alias mbea
join unified.mb_area_alias mbaa
on mbaa.locale = mbea.locale
where mbaa.area_name = 'Canada';

---Query 6

select ea.locale, count(et.name)
from unified.event_alias ea
join unified.event_type et
on ea.type = et.id
group by ea.locale;

---Query 7 no visualization

select name 
from unified.mb_instrument mbi
where gid = (
	select gid, msss.artist_name
	from unified.mb_artist_and_type mbat
	join unified.ms_songs_summary msss
	on mbat.name = msss.artist_name
	where msss.artist_name in (
		select artist_name
		from unified.ms_songs_summary msss
		join unified.ms_songs_popularity mssp
		on msss.song_id = mssp.song
		having mssp.play_count = max(play_count))
	group by msss.artist_name);


--Query 8

SELECT artist_name, duration 
FROM unified.ms_songs_summary
GROUP BY artist_name, duration;
    

--Query 9 

select mbat.name, count(mbat.name)
from unified.mb_artist_and_type mbat
join unified.mb_release_group mbrg
on mbat.id = mbrg.artist_credit
	where mbrg.id in (
		(select release 
		from unified.mb_release_country mbrc
		group by name) t
		join mbrc a on a.name = t.name 
		where mbrc.country = (
			select id 
			from unified.mb_area
			where name = 'USA'));

--Query 10

select r.name, count(r.name)
from unified.mb_recording r
where video = 't' 
group by r.name;

--Query 11

select distinct term, duration
from unified.ms_artist_term msat
join unified.ms_songs_summary msss
on msss.artist_id = msat.artist_id
order by duration desc
limit 10;

---Query 12

select msat.term, count(msat.term)
from unified.ms_artist_term msat
join unified.ms_songs_summary msss
on msss.artist_id = msat.artist_id
group by msat.term
having count(msat.term) > 100000;

