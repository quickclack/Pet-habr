export const getCategoriesAll = (state) => {
      console.log(state.categories.categories)
    return state.categories.categories || []
    // .length == 0 ? [] : state.articles.articles.data.articles
};



