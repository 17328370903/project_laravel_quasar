import instance from "@/plugin/request.js";

export function getProjectList(data = {}) {
    return instance.get("/backend/project/index", {params: data})
}

export function createProject(data) {
    return instance.post("/backend/project/create", data)
}
