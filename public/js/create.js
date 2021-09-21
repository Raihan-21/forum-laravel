const tags = []
const tag = document.querySelector('#tagInput')
const form = document.querySelector('.form')
const tagOutput = document.querySelector('.tags')
const cancel = document.querySelectorAll('.cancel')
const tagSub = document.querySelector('.tagsub')
tag.addEventListener('keyup', function(e) {
    if(e.keyCode === 32){
        tags.push(tag.value)
        console.log(tags)
    }
    
})
tagSub.addEventListener('click', function(){
    tags.push(tag.value)
    console.log(tag.value)
})
// form.addEventListener('keyup', function(e) {
//     if(e.keyCode === 13){
//         e.preventDefault()
//     }
// })