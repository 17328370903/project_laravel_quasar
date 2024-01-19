import instance from "@/plugin/request.js";

//获取树形结构的菜单
export function getTreeMenu() {
    return instance.get("/backend/common/getTreeRoute")
}
