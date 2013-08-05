#!/bin/bash
#config:
music_home=/media/freebox/Musiques

cur_song=$(mpc | head -n 1)
song="$(mpc -f %file% | head -n 1 )"
song_file=${music_home}/${cur_song}
echo "[bookmarked]$song_file" | tee -a $music_home/mpdfavorite.log
