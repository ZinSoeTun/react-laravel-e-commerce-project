import { useState, useEffect } from "react";
import { Helmet } from "react-helmet";
import { useNavigate } from "react-router-dom";
import axios from "axios";

export default function Product() {
    const navigate = useNavigate();

    const [product, setProduct] = useState([]);
    const [category, setCategory] = useState([]);
    const [searchQuery, setSearchQuery] = useState("");
    const [filteredItems, setFilteredItems] = useState([]);
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        setLoading(true);
        axios.get("api/user/category").then((res) => {
            setCategory(res.data.data);
            setLoading(false);
        });
    }, []);

    const handleInputChange = (event) => {
        const query = event.target.value;
        setSearchQuery(query);
        const filtered = category.filter((item) =>
            item.name.toLowerCase().includes(query.toLowerCase())
        );
        // console.log(filtered);
        setFilteredItems(filtered);
    };

    const handleSubmit = (event) => {
        event.preventDefault();
        console.log("Search query:", searchQuery);
        const filtered = category.filter((item) =>
            item.name.toLowerCase().includes(searchQuery.toLowerCase())
        );
        setFilteredItems(filtered);
    };
    //  console.log(filteredItems);

    const proAbout = (id) => {
        navigate(`/product/${id}`);
    };

    return (
        <div>
            <Helmet>
                <title>Prodcut</title>
            </Helmet>
            <h1
                className="text-primary text-center mb-2"
                style={{ marginTop: "100px" }}
            >
                Products
            </h1>
            <h3 className="text-warning text-center mb-5">
                Search Products By Categories
            </h3>
            <div className="container mb-5">
                <form onSubmit={handleSubmit}>
                    <div className="row g-2">
                        <div className="col-md-7 ps-md-5 ms-md-5">
                            <input
                                type="text"
                                className=" form-control border-0 py-3"
                                name="discover"
                                id=""
                                placeholder="Find the location..."
                                value={searchQuery}
                                onChange={handleInputChange}
                            />
                        </div>
                        <div className="col-md-2">
                            <button
                                className="btn btn-success border-0 w-100 py-3"
                                type="submit"
                            >
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
                 {loading? <h1 className="text-primary text-center">Loading...</h1> :  <div className="container mb-5">
                <div className="row g-2">
                    {searchQuery === "" ? (
                        category.map((cat) => (
                            <button
                                className="btn btn-warning col-md-3 col-5 m-2 ps-md-5 ms-md-5"
                                key={cat.id}
                                onClick={() => proAbout(cat.id)}
                            >
                                {cat.name}
                            </button>
                        ))
                    ) : filteredItems.length > 0 ? (
                        filteredItems.map((cat) => (
                            <button
                                className="btn btn-warning col-md-3 col-5 m-2  ps-md-5 ms-md-5"
                                key={cat.id}
                                onClick={() => proAbout(cat.id)}
                            >
                                {cat.name}
                            </button>
                        ))
                    ) : (
                        <h1 className="text-primary text-center">
                            No matching items found
                        </h1>
                    )}
                </div>
            </div>}
        </div>
    );
}
