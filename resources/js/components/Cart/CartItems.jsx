import { useEffect, useState } from "react";
import axios from "axios";
import { Helmet } from "react-helmet";
import { useNavigate } from "react-router-dom";
import Cookies from "universal-cookie";
import americanExpress from "../../../../public/Image/Card/american express.png";
import discover from "../../../../public/Image/Card/discover.png";
import master from "../../../../public/Image/Card/master.png";
import visa from "../../../../public/Image/Card/visa.png";

export default function CartItems() {
    const cookies = new Cookies();
    const navigate = useNavigate();
    const token = cookies.get("loginToken");
    const [cartData, setcartData] = useState([])
    const [cartData2, setcartData2] = useState(cartData)
    const [qtyMap, setQtyMap] = useState({})
    const [loading, setLoading] = useState(false)
    const [error, setError] = useState('')

    useEffect(() => {
        setLoading(true)
        axios
            .get("api/user/product/cart/retrive", {
                headers: {
                    " Authorization ": "Bearer" + token,
                },
            })
            .then((res) => {
                // console.log(res.data.data);
                setcartData(res.data.data)
                setLoading(false)
            });
    }, []);
    // console.log(cartData);

    const convertStringToNumber = (str) => {
        // Remove the comma and dot from the string and replace with empty string
        const cleanedStr = str.replace(/[,.]/g, '');

        // Parse the cleaned string as a float
        return parseFloat(cleanedStr);
    }
    const Add = (id) => {
        setQtyMap(prevQtyMap => ({
            ...prevQtyMap,
            [id]: (prevQtyMap[id] || 1) + 1
        }));
    }
    const Subtract = (id) => {
        if (qtyMap[id] > 1) {
            setQtyMap(prevQtyMap => ({
                ...prevQtyMap,
                [id]: prevQtyMap[id] - 1
            }));
        }
    }
    var totalPrice = 0;
    cartData.forEach(cartData => {
        totalPrice += parseInt(qtyMap[cartData.id] || 1) * convertStringToNumber(cartData.product_price) / 100
    });

    const order = async (e) => {
        e.preventDefault();
        let newData = cartData.map((d) => (
            {
                ...d,
                qty: qtyMap[d.id] || 1,
                total: parseInt(qtyMap[d.id] || 1) * convertStringToNumber(d.product_price) / 100
            }
        ))
        console.log(newData);
        // setNewCartData(newData)
        // console.log(newCartData)
        try {
            const response1 = await axios
                .post("api/user/product/cart/cartItem", {
                    newCartData: newData,
                    subTotal: totalPrice + 1000,
                    productTotalPrice: totalPrice
                }, {
                    headers: {
                        Authorization: "Bearer" + token,
                    },
                })

            const response2 = await axios
                .post("api/user/product/cart/cartItem/order/totalPrice", {
                    subTotal: totalPrice + 1000,
                    productTotalPrice: totalPrice
                }, {
                    headers: {
                        Authorization: "Bearer" + token,
                    },
                })


            const response3 = await axios
                .get("api/user/product/cart/cartItem/delete", {
                    headers: {
                        Authorization: "Bearer" + token,
                    },
                })


            console.log(response1);
            console.log(response2);
            console.log(response3);

            // Check response status and handle accordingly
            if (response1.status === 200 && response2.status === 200
                && response3.status === 200) {
                // Both requests were successful
                console.log("Both requests successful");
                cookies.remove('loginToken')
                navigate('/')
            } else {
                // Handle error
                console.error("One or more requests failed");
            }
        } catch (error) {
            console.error("Error:", error);
        }


    }

    const ord = (text) => {
        alert(`You can order by    ${text} CARD`)
    }

    const delItem = async (id) => {
        if (cartData) {
            setcartData(oldValues => {
                return oldValues.filter(item => item.product_id !== id)
            })
        }
        try {
            const response = await axios
                .get(`api/user/product/cart/cartItem/items/delete/${id}`, {
                    headers: {
                        Authorization: "Bearer" + token,
                    },
                })
            if (response) {
                console.log(response);
            } else {
                console.log(response);
            }
        } catch (error) {
            console.log(error);
        }


    }

    const cartClear = async () => {
        setcartData([])
        try {
            const response = await axios
                .get('api/user/product/cart/cartItem/delete', {
                    headers: {
                        Authorization: "Bearer" + token,
                    },
                })
            if (response) {
                console.log(response);
            } else {
                console.log(response);
            }
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <div>
            <Helmet>
                <title>Cart</title>
            </Helmet>
            <h1 className="text-center text-primary "
                style={{ marginTop: '100px' }}>
                Cart Data - {cartData.length}
            </h1>
            {cartData.length > 1 &&
                <h1 className="text-center text-primary "
                    style={{ marginTop: '100px' }}>
                    there is no
                    <span className="text-danger fs-1">
                        Data
                    </span>
                    in your cart
                </h1>
            }



            {loading ? (
                <h1 className="text-center text-danger">
                    Loading ...
                </h1>
            ) : cartData.length > 0 ? (
                cartData.map((c) => (
                    <div key={c.id}>
                        <div className="item d-flex row   m-3 p-3" >
                            <div className="m-3 col-lg-2 text-center">
                                <img
                                    src={`http://127.0.0.1:8000/storage/product/${c.product_image}`}
                                    alt=""
                                    width={150}
                                    className=" img-fluid img-thumbnail"
                                />
                            </div>
                            <p className="text-primary mt-3 me-lg-4  text-center col-lg-1 col-md-2">{c.product_name}</p>
                            <p className="text-primary mt-3 me-lg-4  text-center col-lg-1 col-md-2">$ {c.product_price}</p>
                            <div className="d-md-flex   mx-auto mx-md-0 col-md-7" style={{ width: '10%' }}>
                                <div className=" mt-4 mx-md-2" onClick={() => Subtract(c.id)}>
                                    <button className="btn btn-success">
                                        -
                                    </button>
                                </div>

                                <div className="mt-4 fs-5">
                                    <input type="text"
                                        value={qtyMap[c.id] || 1}
                                        className=" form-control-sm text-center"
                                        onChange={(e) => setQtyMap({ ...qtyMap, [c.id]: parseInt(e.target.value) || 0 })} />
                                </div>

                                <div className="mt-4 mx-md-2" onClick={() => Add(c.id)}>
                                    <button className="btn btn-success">
                                        +
                                    </button>
                                </div>

                                <div className=" text-center text-primary mt-4 ms-md-4">
                                    $ {parseInt(qtyMap[c.id] || 1) * convertStringToNumber(c.product_price) / 100}
                                </div>

                                <div>
                                    <button className="btn btn-danger mt-4 ms-md-4" onClick={() => delItem(c.product_id)}>
                                        delete
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div>

                        </div>
                    </div>
                ))
            ) : (
                <h1 className="text-center text-warning "
                style={{ marginTop: '100px' }}>
                There is no
                <span className="text-danger fs-1 ms-3 me-3">
                    Data
                </span>
                in your cart
            </h1>
            )}


            {cartData.length > 0 && <>
                <div className="fs-4 text-warning text-center">
                    <p> Total Product Price = $ {totalPrice}</p>
                    <p> Shipping Price = $ 1000</p>
                    <p className="text-danger">Sub Total Price = $ {totalPrice + 1000}</p>
                </div>
                <div className="d-md-flex w-50  mx-auto">
                    <div style={{ cursor: 'pointer' }} className="text-center" onClick={() => ord('AMERICA EXPRESS')}>
                        <img src={americanExpress} alt="" width={150} />
                    </div>
                    <div style={{ cursor: 'pointer' }} className="text-center" onClick={() => ord('DISCOVER')}>
                        <img src={discover} alt="" width={150} />
                    </div>
                    <div style={{ cursor: 'pointer' }} className="text-center" onClick={() => ord('MASTER')}>
                        <img src={master} alt="" width={150} />
                    </div>
                    <div style={{ cursor: 'pointer' }} className="text-center" onClick={() => ord('VISA')}>
                        <img src={visa} alt="" width={150} />
                    </div>
                </div>

                <div className=" d-flex w-25 mx-auto">
                    <button className="btn btn-info me-4 ms-lg-5" onClick={order}>
                        Order
                    </button>
                    <button className="btn btn-danger" onClick={cartClear}>
                        Cart Clear
                    </button>
                </div>

            </>}

        </div>
    )
}
