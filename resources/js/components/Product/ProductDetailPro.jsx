import react, { useState } from 'react'
import {  useNavigate } from "react-router-dom";
import { faCartShopping } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import Cookies from "universal-cookie";
import axios from "axios";

export default function ProductDetailPro({ product }) {
    const cookies = new Cookies();
    let token = cookies.get("loginToken");
    const navigate = useNavigate();
      const [error, setError] = useState('')

    const onAdd = async (id) => {
        // e.preventDefault();

        const productId = {
            productId: id
        };
        try {
            await axios
                .post("api/user/product/cart/add", productId, {
                    headers: {
                        Authorization: "Bearer" + token,
                    },
                })
            // if (response) {
            //    return navigate("/");
            // }else{
            //     console.log(error);
            // }
                .then((res) => {
                console.log(res);
                return navigate("/");
            });
        } catch (error) {
            console.log(error);
            if (error.response.status === 422) {
                setError('Product has already existed in your cart!');
            }
        }
    }
    return (
        <div>
            {error && <div>
                  <h1 className='text-center text-danger'>*{error}</h1>
                </div>}
            <h1 className="text-primary text-center mb-5">
                Products Detail
            </h1>
            <div >
                <img
                    src={`http://127.0.0.1:8000/storage/product/${product.image}`}
                    alt=""
                    width="100%"
                />
            </div>
            <div className=" d-flex mt-4">
                <div className=" ms-lg-5 me-lg-5 ps-lg-5 pe-lg-5 w-100 text-primary text-center">
                    <h2 className="text-warning">Name</h2>
                    <h2>{product.name}</h2>
                </div>
                <div className=" ms-lg-5 me-lg-5 ps-lg-5 pe-lg-5 w-100 text-primary text-center">
                    <h2 className="text-warning">Price</h2>
                    <h2>{product.price}</h2>
                </div>
            </div>
            <div>
                <h1 className="text-warning text-center">Description</h1>
                <p className="text-primary fs-5 ms-lg-4 ms-2">{product.description}</p>
            </div>
            {token && (
                <div className="btn btn-warning ms-lg-5"
                    onClick={() => onAdd(product.id)}>
                    <FontAwesomeIcon
                        icon={faCartShopping}
                        className="me-2"
                    />
                    Add To Cart
                </div>
            )}
        </div>
    )
}
