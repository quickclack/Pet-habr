export const getArticlesAll = (state) => {
    //   console.log(state)
    return state.articles.length == 0 ? [] : state.articles.articles.data.articles
};

export const getArticle = (state) => {
        //  console.log(state)
    return state.articles.length == 0 ? [] :state.articles.article};

export const getPaginationLinks = (state) => {
    //  console.log('state.articles',state.articles)
    return state.articles.length == 0 ? [] : 
        state.articles.articles.meta == undefined ? [] : state.articles.articles.meta.links
};

export const getArticleTags = (state) => {
    //   console.log('state.articles',state.articles.article.tags[0].title)
    return state.articles.length == 0 ? '' : 
        state.articles.article == undefined ? '' : state.articles.article.tags[0].title
};
