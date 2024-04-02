import React from "react";
import { HashRouter, Route, Routes } from "react-router-dom";
import Product from "./Product/Product";
import Home from "./Home/Home";
import Contact from "./Contact/Contact";
import Navbar from './Home/Navbar'
import Footer from './Home/Footer'
import Register from "./Authentication/Register";
import Login from "./Authentication/Login";
import NavFooterHideShow from "./Extra/NavFooterHideShow";
import Profile from "./Authentication/Profile";
import Category from "./Product/Category";
import ProductDetail from "./Product/ProductDetail";
import CartItems from "./Cart/CartItems";
import NotFound from "./NotFound";
import AuthenticatedRoutes from "./AuthenticationRoutes/AuthenticatedRoute"
import UnAuthenticatedRoute from "./AuthenticationRoutes/UnAuthenticatedRoute";

export default function Index() {

    return (
        <HashRouter>
            <NavFooterHideShow>
                <Navbar />
            </NavFooterHideShow>
            <Routes>
                <Route element={<AuthenticatedRoutes />}>
                    <Route element={<CartItems />} path="/cart" />
                    <Route element={<Profile />} path="/profile" />
                </Route>
                <Route element={<UnAuthenticatedRoute />}>
                    <Route path="/register" element={<Register />} />
                    <Route path="/login" element={<Login />} />
                </Route>
                <Route path="/" element={<Home />} />
                <Route path="/product" element={<Product />} />
                <Route path="/product/:categoryId" element={<Category />} />
                <Route path="/product/detail/:productId" element={<ProductDetail />} />
                <Route path="/contact" element={<Contact />} />
                {/* <Route path="/profile" element={<Profile />} />
                <Route path="/cart" element={<CartItems />} /> */}
                <Route path="/*" element={<NotFound />} />
            </Routes>
            <NavFooterHideShow>
                <Footer />
            </NavFooterHideShow>
        </HashRouter>
    );
}
