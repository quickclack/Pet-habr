import { compose, combineReducers, createStore, applyMiddleware } from "redux";
import { persistReducer, persistStore } from "redux-persist";
import thunk from "redux-thunk";
import storage from "redux-persist/lib/storage";

import { articlesReducer } from "./articles";
import { userAuthReducer } from "./userAuth";
import { categoriesReducer } from "./categories";
import { commentsReducer } from "./comments"
import { tagsReducer } from "./tags"
import { bookmarksReducer } from "./bookmarks"
const composeEnhancers = window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ || compose;

const persistConfig = {
  key: "root",
  storage,
};

const rootReducer = combineReducers({
   articles: articlesReducer,
   auth: userAuthReducer,
   categories: categoriesReducer,
   comments: commentsReducer,
   tags: tagsReducer,
   bookmarks: bookmarksReducer,
 });

const persistedReducer = persistReducer(persistConfig, rootReducer);

export const store = createStore(
  persistedReducer,
  composeEnhancers(applyMiddleware(thunk))
);

export const persistor = persistStore(store);