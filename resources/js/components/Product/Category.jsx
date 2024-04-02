import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { Helmet } from "react-helmet";
import axios from "axios";
import "../../../css/app.css";
import { useNavigate } from "react-router-dom";
import CategoryDetail from "./CategoryDetail";
import CategoryRelPro from "./CategoryRelPro";
import Pagination from "./Pagination";



export default function Category() {
    const { categoryId } = useParams();
    const navigate = useNavigate();

    const [category, setCategory] = useState([]);
    const [product, setProduct] = useState([]);
    const [loading, setLoading] = useState(false);
    const [currentPage, setCurrentPage] = useState(1);
    const recordsPerPage = 3;
    const lastIndex = currentPage * recordsPerPage;
    const firstIndex = lastIndex - recordsPerPage;
    const records = product.slice(firstIndex, lastIndex);
    const nPage = Math.ceil(product.length / recordsPerPage);
    const number = [...Array(nPage + 1).keys()].slice(1);

    useEffect(() => {
        setLoading(true);
        axios.get(`api/user/category/dynamic/${categoryId}`).then((res) => {
            setCategory(res.data.category);
            setProduct(res.data.product);
            setLoading(false);
        });
    }, [categoryId]);
    const proDetail = (id) => {
        navigate(`/product/detail/${id}`)
   }
    const nexPage = () => {
        if (currentPage !== nPage) {
            setCurrentPage(currentPage + 1);
        }
    };
    const prePage = () => {
        if (currentPage !== 1) {
            setCurrentPage(currentPage - 1);
        }
    };
    const chaPage = (id) => {
        setCurrentPage(id);
    };

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
                <CategoryDetail category={category}/>
                <CategoryRelPro category={category} records={records} proDetail={proDetail}/>
                 <Pagination nPage={nPage}
                    number={number}
                    currentPage={currentPage}
                    setCurrentPage={setCurrentPage}
                    nexPage={nexPage}
                    prePage={prePage}
                    chaPage={chaPage}
                    />

                </>
            )}
        </div>
    );
}
