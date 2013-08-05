#!/bin/bash
#config
music_home=/media/freebox/Musiques


song_to_remove=$(mpc | head -n 1)
playlist_pos=$(mpc -f %position% | head -n 1)
song="$(mpc -f %file% | head -n 1 )"
song_file=${music_home}/${song}
rm -v "$song_file"
mpc del $playlist_pos
echo "[`date`] -> $song_file now deleted..." >> $music_home/mpdremove.log
