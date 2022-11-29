export const getCategoriesAll = (state) => {
  // console.log(state)
  return state.categories.categories || []
    // .length == 0 ? [] : state.articles.articles.data.articles
};

export const getLinksCategoriesAll = (state) => {
  // console.log(state.categories)
  return state.categories.links || []
};


