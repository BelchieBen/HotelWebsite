function addTags() {
    var tag = document.querySelectorAll('.input-categories');
    for (var tagname = 0; tagname < tag.length; tagname++) {
      tag[tagname]._list = tag[tagname].querySelector('ul');
      tag[tagname]._input = tag[tagname].querySelector('input');
      tag[tagname]._input._icategories = tag[tagname];
      tag[tagname].onkeydown = function(e){
        var e = event || e;
        if(e.keyCode == 13) {
          var c = e.target._icategories;
          var li = document.createElement('li');
          li.innerHTML = c._input.value;
          li.classList.add('pointer');
          c._list.appendChild(li);
          c._input.value = '';
          e.preventDefault();
          li.onclick = function() {
            c._list.removeChild(li)
          };
          getTags();
        }
      }
    }
  }

  function removeTag(li){
    var list = document.getElementById("tagList");
    list.removeChild(li);
  }

  function getTags() {
    var tagInput = document.getElementById("tagInput");
    tagsList = new Array(); 
    var ul = document.getElementById("tagList");
    var items = ul.getElementsByTagName("li");

    for (var i = 0; i < items.length; ++i){
      tagsList.push(items.item(i).innerHTML);
    }
    console.log(tagsList);
    return tagsList;
    
  }

  function SubmitFrm() {
    document.addHotel.tags.value = getTags();
    document.getElementById("addHotel").submit();
  }