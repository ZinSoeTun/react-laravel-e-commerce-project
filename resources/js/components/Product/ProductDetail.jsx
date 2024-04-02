import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { Helmet } from "react-helmet";
import axios from "axios";
import ProductDetailRelCategory from "./ProductDetailRelCategory";
import ProductDetailRelDesigner from "./ProductDetailRelDesigner";
import ProductDetailPro from "./ProductDetailPro";
import BreadCrumb from "./BreadCrumb";

export default function ProductDetail() {
    const { productId } = useParams();

    const [category, setCategory] = useState({});
    const [product, setProduct] = useState({});
    const [designer, setDesigner] = useState({});
    const [cart, setCart] = useState([]);
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        setLoading(true);
        axios.get(`api/user/product/dynamic/${productId}`).then((res) => {
            setCategory(res.data.category);
            setProduct(res.data.product);
            setDesigner(res.data.designer);
            setLoading(false);
        });
    }, [productId]);
    // const onAdd = (product) => {
    //     const exist = cart.find((x) => x.id === product.id);
    //     if (exist) {
    //         setCart(
    //             cart.map((x) =>
    //                 x.id === product.id ? { ...exist, qty: exist.qty + 1 } : x
    //             )
    //         );
    //     } else {
    //         setCart([...cart, { ...product, qty: 1 }]);
    //     }
    // };

    return (
        <div>
            <Helmet>
                <title>Prodcut Detail Page</title>
            </Helmet>
            {loading ? (
                <h1
                    className="text-danger text-center"
                    style={{ marginTop: "100px" }}
                >
                    Loading...
                </h1>
            ) : (
                <>
                    <BreadCrumb product={product} />
                    <ProductDetailPro product={product} />
                    <ProductDetailRelCategory category={category} />
                    <ProductDetailRelDesigner designer={designer} />
                </>
            )}
        </div>
    );
}
