(function() {
    function getAllPosts(callback) {
        var token = '5b87fca85b87fca85b87fca8645bf069ff55b875b87fca83b02ba68ce028cb3a25b392b';
        var version = 5.52;
        var domain = 'zazercalie_air';
        var count = 10;
        var offset = 0;
        all_posts = []
        jQuery.get('https://api.vk.com/method/wall.get', {
            'access_token': token,
            'v': version,
            'domain': domain,
            'count': count,
            'offset': offset
        }, function(data) {
            if (data.response && data.response.items && jQuery.isFunction(callback)) {
                callback(data.response.items);
            }
        }, 'jsonp')
    }

    function toTimeString(timestamp) {
        var arrTimes = 'сек.,мин.,ч.,дн.,нед.,мес.,г.'.split(','),
            arrInt = [1, 60, 3600, 3600 * 24, 3600 * 24 * 7, 3600 * 24 * 30, 3600 * 24 * 365];
        var int = (new Date().getTime() - timestamp) / 1000;
        for (var i = 0; i < arrTimes.length && arrInt[i] < int; ++i);
        return i > 0 ? Math.floor(int / arrInt[--i]) + ' ' + arrTimes[i] + ' назад' : 'только что';
    }

    function getPostsArray(response) {
        var result = [];
        for (var i in response) {
            var post = response[i];
            var id = post.id;
            var link = "https://vk.com/zazercalie_air?w=wall" + post.owner_id + "_" + id + "%2Fall";
            var date = toTimeString(post.date * 1000);
            var text = post.text;
            var s = "";
            s += "<div class=\"vk-post\" id=\"vk-post-" + id + "\">";
            s += "<a href=\"" + link + "\" target=\"_blank\">";
            s += "<div class=\"vk-post-title\">";
            //s += "<div class=\"vk-post-author\">" + name_of_group + "</div>";
            s += "<div class=\"vk-post-date\">" + date + "</div>";
            //s += "<div class=\"vk-post-avatar\"><img src=\"" + avarar_of_group + "\"/></div>";
            s += "</div>";
            s += "<div class=\"vk-post-content\">";
            s += text;
            s += "</div></a>";
            if ('attachments' in post) {
                s += "<div class=\"vk-post-attachments\">";
                var attachments = post.attachments;
                for (var i in attachments) {
                    var attachment = attachments[i];
                    var type = attachment['type'];
                    if (type == "photo") {
                        var url = "";
                        if ('photo_2560' in attachment.photo)
                            url = attachment['photo']['photo_2560'];
                        else if ('photo_1280' in attachment.photo)
                            url = attachment['photo']['photo_1280'];
                        else if ('photo_807' in attachment.photo)
                            url = attachment['photo']['photo_807'];
                        else if ('photo_604' in attachment.photo)
                            url = attachment['photo']['photo_604'];
                        else if ('photo_130' in attachment.photo)
                            url = attachment['photo']['photo_130'];
                        else
                            url = attachment['photo']['photo_75'];
                        s += "<span class=\"vk-post-attachment\">";
                        s += "<a href=\"" + url + "\">";
                        s += "<img src=\"" + (attachment['photo']['photo_604'] || url) + "\">";
                        s += "</a>";
                        s += "</span>";
                    }
                    if (type == 'doc') {
                        var title = attachment['doc']['title'];
                        var size = attachment['doc']['size'];
                        var url = attachment['doc']['url'];
                        s += "<span class=\"vk-post-attachment-description\">";
                        s += "<a href=\"" + url + "\">";
                        s += title;
                        s += " (" + size + " kB)";
                        s += "</a>";
                        s += "</span>";
                    }
                    if (type == 'link') {
                        var title = attachment['link']['title'];
                        var url = attachment['link']['url'];
                        s += "<span class=\"vk-post-attachment-description\">";
                        s += "<a href=\"" + url + "\">";
                        s += title;
                        s += "</a>";
                        s += "</span>";
                    }
                }
                s += "</div>";
            }
            s += "</div>";
            result.push(s);
        }
        return result;
    }

    function outputPosts(postsArray) {
        for (var i in postsArray) {
            jQuery('#vk-wall').append(postsArray[i])
        }
    }

    jQuery(function() {
        getAllPosts(function(data) {
            outputPosts(getPostsArray(data))
        });
    });
})();