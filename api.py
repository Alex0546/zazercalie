import requests
import csv
import datetime
from lxml import etree

def get_all_posts():
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

def take_posts_data(posts):
    for post in posts:
        id = post['id']
        unix_date = post['date']
        date = datetime.datetime.fromtimestamp(unix_date).strftime('%d %b %Y в %H:%M')
        text = post['text']
        if 'attachment' in post:
            attachments = post['attachments']
            for attachment in attachments:
                type = attachment['type']
                if type == "photo":
                    width = attachment['photo']['width']
                    height = attachment['photo']['height']
                    if 'photo_2560' in attachment:
                        url = attachment['photo']['photo_2560']
                    elif 'photo_1280' in attachment:
                        url = attachment['photo']['photo_1280']
                    elif 'photo_807' in attachment:
                        url = attachment['photo']['photo_807']
                    elif 'photo_604' in attachment:
                        url = attachment['photo']['photo_604']
                    elif 'photo_130' in attachment:
                        url = attachment['photo']['photo_130']
                    else:
                        url = attachment['photo']['photo_75']
                if type == 'video':
                    title = attachment['video']['title']
                if type == 'audio':
                    title = attachment['title']
                    artist = attachment['artist']
                    url = attachment['url']
                if type == 'doc':
                    title = attachment['title']
                    size = attachment['size']
                    url = attachment['url']
                if type == 'link':
                    title = attachment['title']
                    url = attachment['url']

def get_name_of_group():
    id_group = 'zazercalie_air'
    url_group = 'https://vk.com/' + id_group
    response = requests.get(url_group)
    html = response.text
    root = etree.fromstring(html)
    return root.xpath('//*[@id="page_block_group_main_info"]/div[1]/h1')[0].text

posts = get_all_posts()
take_posts_data(posts)
name_of_group = get_name_of_group()

print(1)