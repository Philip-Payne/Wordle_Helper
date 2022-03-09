# Wordle Helper

### Introduction

This is a relatively simple help application for playing the popular online game Wordle.

The helper uses a MySQL database to store about 13,000 five letter words and some PHP code to find the possible words and sort these words by order on letter frequency.

To use the helper you need to set up the database and web package. An application such as MAMP or XAMPP will allow you to host the application locally.

Some setup guidance will be added in time but for now you need a little experience with MySQL and PHP to set things up.

### The Algorithm

The reason for creating this helper is to give students an application where they can adjust the underlying algorithm and see the change in results.

Currently the code finds the allowed words and then finds the frequency of each letter in each of the five positions. A list of the 100 highest ranking words is then returned. While this works perfectly well there are a number of ways that the algorithm could be improved this is left as an exercise for the reader!

[![A test image](https://live.staticflickr.com/65535/51926919168_f076e17159_b.jpg)]
