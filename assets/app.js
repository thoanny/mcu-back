import './app.css';

const addFormToCollection = (e) => {
    const collectionHolder = document.querySelector('#' + e.currentTarget.dataset.collectionHolderId);
    const item = document.createElement('div');
    const numberOfChildren = collectionHolder.children.length;

    item.innerHTML = collectionHolder
        .dataset
        .prototype
        .replace(
            /__name__/g,
            numberOfChildren
        );

    collectionHolder.appendChild(item);
    collectionHolder.dataset.index++;
};

['#movie_add_vod', '#show_add_episode', '#show_add_vod'].forEach(el => {
    if(document.querySelector(el)) {
        document.querySelector(el).addEventListener("click", addFormToCollection);
    }
});