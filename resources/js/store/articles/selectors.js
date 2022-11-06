export const getArticlesAll = (state) => {
    //  console.log(state.articles.articles.data.articles)
    return state.articles.articles.data.articles
};

export const getArticle = (state) => {
        //  console.log(state)
    return state.articles.article};

export const getPaginationLinks = (state) => {
    // console.log(state.articles.articles.meta.links)
    return state.articles.articles.meta.links
};