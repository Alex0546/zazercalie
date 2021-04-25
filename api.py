import requests
import csv

def take_1000_posts():
    token = '5b87fca85b87fca85b87fca8645bf069ff55b875b87fca83b02ba68ce028cb3a25b392b'
    version = 5.52
    domain = 'zazercalie_air'
    count = 100
    offset = 0
    all_posts = []

    while offset < 1000:
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

all_posts = take_1000_posts()

print(1)