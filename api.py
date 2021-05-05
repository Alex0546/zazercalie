import requests
import csv
import datetime

def take_all_posts():
    token = '5b87fca85b87fca85b87fca8645bf069ff55b875b87fca83b02ba68ce028cb3a25b392b'
    version = 5.52
    domain = 'zazercalie_air'
    count = 100
    offset = 0
    all_posts = []
    response = requests.get('https://api.vk.com/method/wall.get', 
                                params = {
                                    'access_token': token,
                                    'v': version,
                                    'domain': domain,
                                    'count': count,
                                    'offset': offset
                                })
    num_of_posts = response.json()['response']['count']
    while offset < num_of_posts:
        response = requests.get('https://api.vk.com/method/wall.get', 
                                params = {
                                    'access_token': token,
                                    'v': version,
                                    'domain': domain,
                                    'count': count,
                                    'offset': offset
                                })
        data = response.json()['response']['items']
        offset += 100
        all_posts.extend(data)
    return all_posts

posts = take_all_posts()
for post in posts:
    id = post['id']
    unix_datetime = post['date']
    normal_datetime = datetime.datetime.fromtimestamp(unix_datetime).strftime('%d %b %Y в %H:%M')
    text = post['text']
    for attachment in post['attachments']:
        type = attachment['type']